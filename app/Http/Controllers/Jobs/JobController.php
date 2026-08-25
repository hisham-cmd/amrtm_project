<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Jobs\JobListing;
use App\Models\Jobs\Company;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function create()
    {
        return view('jobs.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_main_type'       => 'required|string',
            'job_category'        => 'required|string',
            'title'               => 'required|string|max:255',
            'job_type'            => 'required|string',
            'experience_level'    => 'required|string',
            'positions_available' => 'required|integer|min:1',
            'salary_min'          => 'nullable|numeric|min:0',
            'salary_max'          => 'nullable|numeric|min:0',
            'location'            => 'required|string|max:255',
            'deadline'            => 'nullable|date',
            'description'         => 'required|string',
            'required_skills'     => 'nullable|json',
            'languages'           => 'nullable|json',
            'benefits'            => 'nullable|json',
        ]);

        $validated['required_skills'] = $request->required_skills ? json_decode($request->required_skills, true) : [];
        $validated['languages']       = $request->languages       ? json_decode($request->languages, true)       : [];
        $validated['benefits']        = $request->benefits        ? json_decode($request->benefits, true)        : [];
        $validated['company_id']      = auth('jobs')->user()->company->id;
        $validated['status']          = 'active';

        JobListing::create($validated);

        return redirect()->route('jobs.company.dashboard')->with('success', 'تم نشر الوظيفة بنجاح!');
    }

    public function show(JobListing $job)
    {
        return view('jobs.jobs.show', compact('job'));
    }

    public function edit(JobListing $job)
    {
        $this->authorize('update', $job);
        return view('jobs.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'job_main_type'       => 'required|string',
            'job_category'        => 'required|string',
            'title'               => 'required|string|max:255',
            'job_type'            => 'required|string',
            'experience_level'    => 'required|string',
            'positions_available' => 'required|integer|min:1',
            'salary_min'          => 'nullable|numeric|min:0',
            'salary_max'          => 'nullable|numeric|min:0',
            'location'            => 'required|string|max:255',
            'deadline'            => 'nullable|date',
            'description'         => 'required|string',
            'required_skills'     => 'nullable|json',
            'languages'           => 'nullable|json',
            'benefits'            => 'nullable|json',
        ]);

        $validated['required_skills'] = $request->required_skills ? json_decode($request->required_skills, true) : [];
        $validated['languages']       = $request->languages       ? json_decode($request->languages, true)       : [];
        $validated['benefits']        = $request->benefits        ? json_decode($request->benefits, true)        : [];

        $job->update($validated);

        return redirect()->route('jobs.company.dashboard')->with('success', 'تم تحديث الوظيفة بنجاح!');
    }

    public function destroy(JobListing $job)
    {
        $this->authorize('delete', $job);
        $job->delete();

        return redirect()->route('jobs.company.dashboard')->with('success', 'تم حذف الوظيفة بنجاح!');
    }
}
