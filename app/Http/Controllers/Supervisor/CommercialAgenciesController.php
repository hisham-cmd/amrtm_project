<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\CommercialAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommercialAgenciesController extends Controller
{
    public function index()
    {
        $agencies = CommercialAgency::orderByDesc('is_featured')->orderBy('sort_order')->get();
        return view('supervisor.agencies.index', compact('agencies'));
    }

    public function create()
    {
        return view('supervisor.agencies.form', [
            'agency'       => null,
            'categories'   => CommercialAgency::$categories,
            'agencyTypes'  => CommercialAgency::$agencyTypes,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('agency-logos', 'public');
        }
        CommercialAgency::create($data);
        return redirect()->route('supervisor.agencies.index')->with('success', 'تمت إضافة الوكالة بنجاح.');
    }

    public function edit(CommercialAgency $agency)
    {
        return view('supervisor.agencies.form', [
            'agency'      => $agency,
            'categories'  => CommercialAgency::$categories,
            'agencyTypes' => CommercialAgency::$agencyTypes,
        ]);
    }

    public function update(Request $request, CommercialAgency $agency)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            if ($agency->logo) Storage::disk('public')->delete($agency->logo);
            $data['logo'] = $request->file('logo')->store('agency-logos', 'public');
        }
        $agency->update($data);
        return redirect()->route('supervisor.agencies.index')->with('success', 'تم تحديث الوكالة.');
    }

    public function destroy(CommercialAgency $agency)
    {
        if ($agency->logo) Storage::disk('public')->delete($agency->logo);
        $agency->delete();
        return redirect()->route('supervisor.agencies.index')->with('success', 'تم حذف الوكالة.');
    }

    public function toggle(CommercialAgency $agency)
    {
        $agency->update(['status' => $agency->status === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'تم تغيير حالة الوكالة.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'name_en'              => 'nullable|string|max:255',
            'logo'                 => 'nullable|image|max:4096',
            'category'             => 'required|string',
            'description'          => 'nullable|string',
            'description_en'       => 'nullable|string',
            'country_origin'       => 'nullable|string|max:100',
            'agency_type'          => 'required|string',
            'investment_min'       => 'required|integer|min:0',
            'investment_max'       => 'required|integer|min:0',
            'min_years_experience' => 'nullable|integer|min:0',
            'requirements_text'    => 'nullable|string',
            'benefits_text'        => 'nullable|string',
            'sort_order'           => 'nullable|integer',
            'status'               => 'in:active,inactive,draft',
            'is_featured'          => 'boolean',
            'is_verified'          => 'boolean',
        ]);

        $data['requirements']    = array_values(array_filter(array_map('trim', explode("\n", $request->input('requirements_text', '')))));
        $data['benefits']        = array_values(array_filter(array_map('trim', explode("\n", $request->input('benefits_text', '')))));
        $data['available_regions'] = $request->input('available_regions', []);
        $data['is_featured']     = $request->boolean('is_featured');
        $data['is_verified']     = $request->boolean('is_verified', true);
        $data['sort_order']      = $data['sort_order'] ?? 0;
        $data['status']          = $request->input('status', 'active');
        unset($data['requirements_text'], $data['benefits_text']);

        return $data;
    }
}
