<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Jobs\JobSpecialization;
use Illuminate\Http\Request;

class JobSpecializationController extends Controller
{
    /**
     * GET /api/specializations?type=leadership
     * يُرجع قائمة التخصصات الديناميكية حسب نوع الوظيفة
     */
    public function index(Request $request)
    {
        $type = $request->query('type');

        if (! in_array($type, ['leadership', 'professional', 'administrative'])) {
            return response()->json([], 422);
        }

        $specializations = JobSpecialization::active()
            ->ofType($type)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'icon']);

        return response()->json($specializations);
    }
}
