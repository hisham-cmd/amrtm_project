<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Jobs\JobListing as Job;
use App\Models\Jobs\Company;
use App\Models\Jobs\JobSeeker;
use App\Models\Jobs\Application;
use App\Models\Jobs\JobSpecialization;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /* ─────────────────────────────────────────────
     | SHARED: فلترة الوظائف
     ─────────────────────────────────────────────*/
 private function filterJobs(Request $request, array|string $mainType)
    {
        $query = Job::where('status', 'active')
            ->whereIn('job_main_type', (array) $mainType)
            ->with('company');

        // الكلمة المفتاحية
        if ($keyword = $request->input('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('company', fn($c) => $c->where('company_name', 'LIKE', "%{$keyword}%"));
            });
        }

        // ★ فلتر التخصص — يبحث في عنوان الوظيفة ووصفها ★
        if ($spec = $request->input('specialization')) {
            $query->where(function ($q) use ($spec) {
                $q->where('title', 'LIKE', "%{$spec}%")
                  ->orWhere('description', 'LIKE', "%{$spec}%");
            });
        }

        // نوع الدوام
        if ($jobType = $request->input('job_type')) {
            $query->where('job_type', $jobType);
        }

        // الموقع
        if ($location = $request->input('location')) {
            $query->where('location', 'LIKE', "%{$location}%");
        }

        // مستوى الخبرة
        if ($level = $request->input('experience_level')) {
            $query->where('experience_level', $level);
        }

        // الراتب الأدنى
        if ($salMin = $request->input('salary_min')) {
            $query->where('salary_min', '>=', (int) $salMin);
        }

        // الراتب الأقصى
        if ($salMax = $request->input('salary_max')) {
            $query->where('salary_max', '<=', (int) $salMax);
        }

        // عدد الشواغر
        if ($positions = $request->input('positions')) {
            if ($positions == 1) {
                $query->where('positions_available', 1);
            } elseif ($positions == 5) {
                $query->where('positions_available', '<=', 5);
            } elseif ($positions == 10) {
                $query->where('positions_available', '>', 5);
            }
        }

        // الموعد النهائي
        if ($deadline = $request->input('deadline_before')) {
            $query->whereDate('deadline', '<=', $deadline);
        }

        // الترتيب
        match ($request->input('sort', 'latest')) {
            'salary_high' => $query->orderByDesc('salary_max'),
            'salary_low'  => $query->orderBy('salary_min'),
            'deadline'    => $query->orderBy('deadline'),
            default       => $query->latest(),
        };

        return $query->paginate(6)->withQueryString();
    }

    /* ─────────────────────────────────────────────
     | SHARED: فلترة الباحثين
     ─────────────────────────────────────────────*/
  private function filterSeekers(Request $request, array|string $seekerType)
    {
      $query = JobSeeker::whereIn('seeker_type', (array) $seekerType);

        // الكلمة المفتاحية
        if ($keyword = $request->input('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('job_title', 'LIKE', "%{$keyword}%")
                  ->orWhere('bio', 'LIKE', "%{$keyword}%");
            });
        }

        // ★ فلتر تخصص الباحث — يطابق حقل desired_specialization ★
        if ($spec = $request->input('seeker_specialization')) {
            $query->where('desired_specialization', $spec);
        }

        // المهارات
        if ($skills = $request->input('skills')) {
            $skillList = array_map('trim', explode(',', $skills));
            $query->where(function ($q) use ($skillList) {
                foreach ($skillList as $skill) {
                    $q->orWhere('skills', 'LIKE', "%{$skill}%");
                }
            });
        }

        // الموقع
        if ($location = $request->input('location')) {
            $query->where('location', 'LIKE', "%{$location}%");
        }

        // مستوى الخبرة
        if ($level = $request->input('experience_level')) {
            $query->where('experience_level', $level);
        }

        // الراتب المتوقع الأدنى
        if ($salMin = $request->input('salary_min')) {
            $query->where('expected_salary_min', '>=', (int) $salMin);
        }

        // الراتب المتوقع الأقصى
        if ($salMax = $request->input('salary_max')) {
            $query->where('expected_salary_max', '<=', (int) $salMax);
        }

        // نوع الدوام المفضل
        if ($jobType = $request->input('job_type')) {
            $query->where('job_type', $jobType);
        }

        // الترتيب
        match ($request->input('sort', 'latest')) {
            'salary_high' => $query->orderByDesc('expected_salary_max'),
            'salary_low'  => $query->orderBy('expected_salary_min'),
            'name'        => $query->orderBy('first_name'),
            default       => $query->latest(),
        };

        return $query->paginate(8)->withQueryString();
    }

    /* ─────────────────────────────────────────────
     | SHARED: جلب التخصصات حسب النوع
     ─────────────────────────────────────────────*/
    private function getSpecializations(string $seekerType)
    {
        return JobSpecialization::active()
            ->ofType($seekerType)
            ->orderBy('sort_order')
            ->get(['id', 'title']);
    }

    /* ─────────────────────────────────────────────
     | ROUTES
     ─────────────────────────────────────────────*/

    public function executiveJobs(Request $request)
    {
        return view('jobs.services.executive-jobs', [
            'jobs'               => $this->filterJobs($request, 'leadership'),
            'jobSeekers'         => $this->filterSeekers($request, 'leadership'),
            'specializations'    => $this->getSpecializations('leadership'),
            'serviceTitle'       => 'الوظائف القيادية',
            'serviceDescription' => 'استقطاب القيادات التنفيذية العليا وأصحاب الخبرات المتميزة',
        ]);
    }

  public function professionalJobs(Request $request)
    {
      
        $types = ['professional', 'administrative'];

        // ── فلترة كوادر ──
        $cadresQuery = Application::where('application_type', 'cadres')
            ->where('status', 'pending');

        if ($keyword = $request->input('cadres_keyword')) {
            $cadresQuery->where(function ($q) use ($keyword) {
                $q->where('first_name',        'LIKE', "%{$keyword}%")
                  ->orWhere('last_name',        'LIKE', "%{$keyword}%")
                  ->orWhere('job_title_desired', 'LIKE', "%{$keyword}%")
                  ->orWhere('nationality',       'LIKE', "%{$keyword}%");
            });
        }

        if ($country = $request->input('cadres_country')) {
            $cadresQuery->where(function ($q) use ($country) {
                $q->where('nationality',     'LIKE', "%{$country}%")
                  ->orWhere('origin_country', 'LIKE', "%{$country}%");
            });
        }

        if ($eduLevel = $request->input('cadres_edu')) {
            $cadresQuery->where('education_level', $eduLevel);
        }

        if ($jobType = $request->input('cadres_job_type')) {
            $cadresQuery->where('desired_job_type', $jobType);
        }

        match ($request->input('cadres_sort', 'latest')) {
            'name'  => $cadresQuery->orderBy('first_name'),
            default => $cadresQuery->latest(),
        };

        return view('jobs.services.professional-jobs', [
            'jobs'               => $this->filterJobs($request, $types),
            'jobSeekers'         => $this->filterSeekers($request, $types),
            'cadresApplications' => $cadresQuery->paginate(9)->withQueryString(),
            'specializations'    => $this->getSpecializations('professional')
                                        ->merge($this->getSpecializations('administrative'))
                                        ->unique('id')
                                        ->values(),
            'serviceTitle'       => 'الوظائف المهنية والإدارية',
            'serviceDescription' => 'توفير الكفاءات المهنية والإدارية المتخصصة في مختلف القطاعات',
        ]);
    }

    public function administrativeJobs(Request $request)
    {
        return view('services.administrative-jobs', [
            'jobs'               => $this->filterJobs($request, 'administrative'),
            'jobSeekers'         => $this->filterSeekers($request, 'administrative'),
            'specializations'    => $this->getSpecializations('administrative'),
            'serviceTitle'       => 'الوظائف الإدارية',
            'serviceDescription' => 'حلول متكاملة لتوظيف الكوادر الإدارية والمكتبية',
        ]);
    }

    public function manpowerCompanies(Request $request)
    {
        $companies = Company::where('company_type', 'transfer')
            ->where('is_verified', true)
            ->with(['user', 'jobs'])
            ->paginate(9)->withQueryString();

        return view('jobs.services.manpower-companies', [
            'companies'          => $companies,
            'serviceTitle'       => 'شركات ترغب التنازل عن العمالة',
            'serviceDescription' => 'توفير القوى العاملة المدربة للمشاريع الكبرى والمنشآت',
        ]);
    }

    public function recruitmentCompanies(Request $request)
    {
        $companies = Company::where('company_type', 'employment')
            ->where('is_verified', true)
            ->with(['user', 'jobs'])
            ->paginate(9)->withQueryString();

        return view('jobs.services.recruitment-companies', [
            'companies'          => $companies,
            'serviceTitle'       => 'شركات التوظيف',
            'serviceDescription' => 'تقنيات ذكاء اصطناعي لمطابقة المرشحين مع الوظائف المناسبة',
        ]);
    }

    public function staffingCompanies(Request $request)
    {
        $companies = Company::where('company_type', 'leasing')
            ->where('is_verified', true)
            ->with(['user', 'jobs'])
            ->paginate(9)->withQueryString();

        return view('jobs.services.staffing-companies', [
            'companies'          => $companies,
            'serviceTitle'       => 'شركات تأجير العمالة',
            'serviceDescription' => 'إدارة شاملة لعقود التوظيف والتعاقد مع ضمان الامتثال',
        ]);
    }

    public function otherCompanies(Request $request)
    {
        $companies = Company::where('company_type', 'other')
            ->where('is_verified', true)
            ->with(['user', 'jobs'])
            ->paginate(9)->withQueryString();

        return view('services.other-companies', [
            'companies'          => $companies,
            'serviceTitle'       => 'شركات أخرى',
            'serviceDescription' => 'شركات متنوعة تقدم خدمات توظيف متعددة',
        ]);
    }
}
