<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\FranchiseApplication;
use Illuminate\Http\Request;

class FranchiseApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $apps = FranchiseApplication::with('opportunity')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(20);

        return view('supervisor.franchise-applications', compact('apps'));
    }

    public function updateStatus(Request $request, FranchiseApplication $app)
    {
        $request->validate(['status' => 'required|in:pending,reviewing,approved,rejected']);
        $app->update(['status' => $request->status]);
        return back()->with('success', 'تم تحديث حالة الطلب.');
    }

    public function destroy(FranchiseApplication $app)
    {
        $app->delete();
        return back()->with('success', 'تم حذف الطلب.');
    }
}
