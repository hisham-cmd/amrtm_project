<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\FranchiseOpportunity;
use App\Models\FranchiseOpportunityStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FranchiseOpportunityController extends Controller
{
    public function index()
    {
        $opportunities = FranchiseOpportunity::withCount('steps')->orderBy('sort_order')->get();
        return view('supervisor.franchise.index', compact('opportunities'));
    }

    public function create()
    {
        return view('supervisor.franchise.form', [
            'opportunity' => null,
            'categories'  => FranchiseOpportunity::$categories,
            'allRegions'  => FranchiseOpportunity::$regions,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('franchise-logos', 'public');
        }
        $opportunity = FranchiseOpportunity::create($data);
        $this->syncSteps($opportunity, $request);

        return redirect()->route('supervisor.franchise.index')->with('success', 'تمت إضافة الامتياز بنجاح.');
    }

    public function edit(FranchiseOpportunity $franchise)
    {
        $franchise->load('steps');
        return view('supervisor.franchise.form', [
            'opportunity' => $franchise,
            'categories'  => FranchiseOpportunity::$categories,
            'allRegions'  => FranchiseOpportunity::$regions,
        ]);
    }

    public function update(Request $request, FranchiseOpportunity $franchise)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            if ($franchise->logo) Storage::disk('public')->delete($franchise->logo);
            $data['logo'] = $request->file('logo')->store('franchise-logos', 'public');
        }
        $franchise->update($data);
        $this->syncSteps($franchise, $request);

        return redirect()->route('supervisor.franchise.index')->with('success', 'تم تحديث الامتياز.');
    }

    public function destroy(FranchiseOpportunity $franchise)
    {
        if ($franchise->logo) Storage::disk('public')->delete($franchise->logo);
        $franchise->delete();
        return redirect()->route('supervisor.franchise.index')->with('success', 'تم حذف الامتياز.');
    }

    public function toggle(FranchiseOpportunity $franchise)
    {
        $franchise->update(['status' => $franchise->status === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'تم تغيير حالة الامتياز.');
    }

    // ────────────────────────────────────────────
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'name_en'              => 'nullable|string|max:255',
            'logo'                 => 'nullable|image|max:4096',
            'category'             => 'required|string',
            'description'          => 'nullable|string',
            'icon'                 => 'required|string|max:100',
            'gradient_from'        => 'required|string|max:30',
            'gradient_to'          => 'required|string|max:30',
            'badge_text'           => 'nullable|string|max:60',
            'investment_min'       => 'required|integer|min:0',
            'investment_max'       => 'required|integer|min:0',
            'roi_months_min'       => 'required|integer|min:1',
            'roi_months_max'       => 'required|integer|min:1',
            'franchise_fee_percent'=> 'required|numeric|min:0|max:100',
            'available_regions'    => 'nullable|array',
            'requirements_text'    => 'nullable|string',
            'sort_order'           => 'integer',
            'is_featured'          => 'boolean',
            'status'               => 'in:active,inactive',
        ]);

        // Convert textarea lines to JSON array
        $data['requirements'] = array_filter(
            array_map('trim', explode("\n", $request->input('requirements_text', '')))
        );
        unset($data['requirements_text']);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['status']      = $request->input('status', 'active');

        return $data;
    }

    private function syncSteps(FranchiseOpportunity $opportunity, Request $request): void
    {
        $opportunity->steps()->delete();

        $titles       = $request->input('step_title', []);
        $descriptions = $request->input('step_description', []);
        $icons        = $request->input('step_icon', []);

        foreach ($titles as $i => $title) {
            if (trim($title) === '') continue;
            FranchiseOpportunityStep::create([
                'opportunity_id' => $opportunity->id,
                'title'          => $title,
                'description'    => $descriptions[$i] ?? '',
                'icon'           => $icons[$i] ?? 'fa-circle',
                'sort_order'     => $i,
            ]);
        }
    }
}
