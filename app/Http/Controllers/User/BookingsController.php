<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OfficiantBooking;
use Illuminate\View\View;

class BookingsController extends Controller
{
    public function index(): View
    {
        $bookings = OfficiantBooking::with(['officiant.user', 'service'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('user.my-bookings', compact('bookings'));
    }
}
