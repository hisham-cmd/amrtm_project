<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Officiant;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Response;

class OfficiantProfileController extends Controller
{
    public function show(Officiant $officiant)
    {
        abort_if($officiant->status !== 'active', 404);

        $officiant->load(['user', 'services', 'media']);

        $others = Officiant::with('user')
            ->whereHas('user')
            ->where('status', 'active')
            ->where('id', '!=', $officiant->id)
            ->take(6)
            ->get();

        $qrCodeUrl = route('officiants.qr', ['officiant' => $officiant], false);
        $qrCodeSvg = (new Writer(new ImageRenderer(new RendererStyle(400, 10), new SvgImageBackEnd())))
            ->writeString(url(route('officiants.profile', ['officiant' => $officiant], false)));

        return view('service.officiant_profile', compact('officiant', 'others', 'qrCodeUrl', 'qrCodeSvg'));
    }

    public function qrCode(Officiant $officiant): Response
    {
        abort_if($officiant->status !== 'active', 404);

        $profileUrl = url(route('officiants.profile', ['officiant' => $officiant], false));

        $renderer = new ImageRenderer(
            new RendererStyle(400, 10),
            new SvgImageBackEnd()
        );

        $svg = (new Writer($renderer))->writeString($profileUrl);

        return response($svg, 200, [
            'Content-Type'        => 'image/svg+xml',
            'Cache-Control'       => 'public, max-age=86400',
            'Content-Disposition' => 'inline; filename="officiant-' . $officiant->id . '-qr.svg"',
        ]);
    }
}
