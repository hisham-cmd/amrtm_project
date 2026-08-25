<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Jobs\JobListing;
use App\Models\Jobs\Application;
use App\Models\Jobs\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function company()
    {
        $user    = auth('jobs')->user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('jobs.company.create');
        }

        $applications_count = Application::whereIn('job_id', $company->jobs()->pluck('id'))->count();

        $recent_applications = Application::whereIn('job_id', $company->jobs()->pluck('id'))
            ->latest()
            ->limit(5)
            ->get();

        $reviews = $company->reviews()->latest()->limit(5)->get();

        return view('jobs.dashboard.company', compact(
            'company',
            'applications_count',
            'recent_applications',
            'reviews'
        ));
    }

    public function jobSeeker()
    {
        $user       = auth('jobs')->user();
        $job_seeker = $user->jobSeeker;

        if (!$job_seeker) {
            abort(404, 'Job seeker profile not found');
        }

        $applications_count = $job_seeker->applications()->count();
        $accepted_count     = $job_seeker->applications()->where('status', 'accepted')->count();

        return view('jobs.dashboard.job-seeker', [
            'job_seeker'         => $job_seeker,
            'applications_count' => $applications_count,
            'accepted_count'     => $accepted_count,
            'saved_jobs'         => 0,
            'views'              => 0,
        ]);
    }

    public function profile()
    {
        $company = auth('jobs')->user()->company;

        if (!$company) {
            return redirect()->route('jobs.company.create');
        }

        return view('jobs.dashboard.profile', compact('company'));
    }
}
