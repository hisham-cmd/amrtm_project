<?php

namespace App\Http\Controllers\Supervisor;

use App\Enums\HallStatus;
use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HallController extends Controller
{
    public function create()
    {
        $owners = User::where('role', 'owner')->orderBy('name')->get();
        return view('supervisor.create-hall', compact('owners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'owner_id'                   => 'required|exists:users,id',
            'name'                       => 'required|string|max:255',
            'city'                       => 'required|string|max:100',
            'location'                   => 'required|string|max:500',
            'description'                => 'nullable|string',
            'capacity'                   => 'required|integer|min:1',
            'max_tables'                 => 'required|integer|min:1',
            'price_per_day'              => 'required|numeric|min:0',
            'whatsapp_number'            => 'nullable|string|max:20',
            'registration_commission_rate' => 'nullable|numeric|min:0|max:100',
            'profile_photo'              => 'nullable|image|max:4096',
            'cover_photo'                => 'nullable|image|max:4096',
        ]);

        $data['status'] = HallStatus::Active;
        $data['registered_by'] = Auth::id();

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('halls/photos', 'public');
        }
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('halls/covers', 'public');
        }

        Hall::create($data);

        return redirect()->route('supervisor.halls')->with('success', 'تم تسجيل القاعة وتفعيلها بنجاح.');
    }
}
