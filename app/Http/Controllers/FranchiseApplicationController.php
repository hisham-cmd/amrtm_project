<?php

namespace App\Http\Controllers;

use App\Models\FranchiseApplication;
use App\Models\FranchiseOpportunity;
use Illuminate\Http\Request;

class FranchiseApplicationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'opportunity_id'  => 'nullable|exists:franchise_opportunities,id',
            'brand_name'      => 'nullable|string|max:255',
            'full_name'       => 'required|string|max:255',
            'phone'           => 'required|string|max:30',
            'email'           => 'required|email|max:255',
            'region'          => 'nullable|string|max:100',
            'capital_range'   => 'nullable|string|max:100',
            'has_experience'  => 'nullable|boolean',
            'notes'           => 'nullable|string|max:1000',
        ]);

        $data['has_experience'] = $request->boolean('has_experience');

        FranchiseApplication::create($data);

        return response()->json(['success' => true, 'message' => 'تم إرسال طلبك بنجاح! سيتواصل معك فريقنا خلال 48 ساعة.']);
    }
}
