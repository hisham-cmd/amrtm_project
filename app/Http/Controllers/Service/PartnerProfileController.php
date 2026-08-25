<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerCategory;

class PartnerProfileController extends Controller
{
    public function show(Partner $partner)
    {
        abort_if($partner->status !== 'active', 404);

        $partner->load(['category', 'media', 'services', 'user']);

        $featureCategories = PartnerCategory::orderBy('name')->pluck('name');
        $partnersByCategory = PartnerCategory::with(['partners' => fn($q) => $q->where('status', 'active')])
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn($cat) => [
                $cat->name => $cat->partners->map(fn($p) => [
                    'id'          => $p->id,
                    'name'        => $p->company_name,
                    'logo_url'    => $p->logo_url,
                    'description' => $p->description,
                    'phone'       => $p->phone,
                    'whatsapp'    => $p->whatsapp,
                    'profile_url' => route('partners.profile', $p->id),
                ])->values(),
            ])
            ->toArray();

        return view('service.partner_profile', compact('partner', 'featureCategories', 'partnersByCategory'));
    }
}
