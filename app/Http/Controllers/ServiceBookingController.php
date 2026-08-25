<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    public function store(Request $request, Partner $partner)
    {
        $request->validate([
            'event_date' => 'required|date|after_or_equal:today',
            'partner_service_id' => 'nullable|exists:partner_services,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $booking = ServiceBooking::create([
            'user_id' => auth()->id(),
            'partner_id' => $partner->id,
            'partner_service_id' => $request->partner_service_id,
            'event_date' => $request->event_date,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return back()->with('success', 'تم تقديم طلب الحجز بنجاح! سيتم التواصل معك قريباً.');
    }
}
