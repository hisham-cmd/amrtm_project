<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Officiant;
use App\Models\OfficiantBooking;
use Illuminate\Http\Request;

class OfficiantBookingController extends Controller
{
    public function store(Request $request, Officiant $officiant)
    {
        abort_if($officiant->status !== 'active', 404);

        $request->validate([
            'phone'                => 'required|string|max:20',
            'event_date'           => 'required|date|after_or_equal:today',
            'officiant_service_id' => 'nullable|exists:officiant_services,id',
            'notes'                => 'nullable|string|max:1000',
        ]);

        $alreadyBooked = OfficiantBooking::where('user_id', auth()->id())
            ->where('officiant_id', $officiant->getKey())
            ->where('event_date', $request->event_date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        abort_if($alreadyBooked, 422, 'لديك حجز مسبق مع هذا المأذون في نفس التاريخ.');

        OfficiantBooking::create([
            'user_id'              => auth()->id(),
            'officiant_id'         => $officiant->id,
            'officiant_service_id' => $request->officiant_service_id,
            'event_date'           => $request->event_date,
            'phone'                => $request->phone,
            'notes'                => $request->notes,
            'status'               => 'pending',
        ]);

        return back()->with('success', 'تم تقديم طلب الحجز بنجاح! سيتم التواصل معك قريباً.');
    }
}
