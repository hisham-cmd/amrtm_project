<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /* ══════════════════════════════
       ADMIN Dashboard Stats
    ══════════════════════════════ */
    public function adminStats(Request $request)
    {
        if (!$request->user()?->isAdmin()) abort(403);

        $total      = ServiceRequest::count();
        $pending    = ServiceRequest::where('status', 'pending')->count();
        $processing = ServiceRequest::whereIn('status', ['processing', 'in_progress'])->count();
        $done       = ServiceRequest::where('status', 'done')->count();
        $rejected   = ServiceRequest::where('status', 'rejected')->count();
        $users      = User::where('role', 'user')->count();

        // Revenue
        $totalRevenue = Payment::where('type', 'payment')
                               ->where('status', 'completed')
                               ->sum('amount');

        $weekRevenue  = Payment::where('type', 'payment')
                               ->where('status', 'completed')
                               ->where('created_at', '>=', now()->subDays(7))
                               ->sum('amount');

        $avgValue = $total > 0
            ? Payment::where('type', 'payment')->avg('amount')
            : 0;

        // Last 7 days chart
        $last7 = collect(range(6, 0))->map(function ($i) {
            $date = now()->subDays($i);
            return [
                'date'  => $date->format('Y-m-d'),
                'label' => $date->locale('ar')->isoFormat('ddd'),
                'count' => ServiceRequest::whereDate('created_at', $date)->count(),
            ];
        });

        // Top services (last 30 days)
        $topServices = ServiceRequest::select(
                'service_id',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(price) as total_revenue')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->with('service.entity')
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->map(fn($r) => [
                'service_id'    => $r->service_id,
                'name_ar'       => $r->service?->name_ar,
                'name_en'       => $r->service?->name_en,
                'entity_ar'     => $r->service?->entity?->name_ar,
                'entity_en'     => $r->service?->entity?->name_en,
                'icon'          => $r->service?->icon,
                'color'         => $r->service?->entity?->color,
                'bg'            => $r->service?->entity?->bg,
                'count'         => $r->count,
                'total_revenue' => $r->total_revenue,
            ]);

        return response()->json([
            'requests' => [
                'total'      => $total,
                'pending'    => $pending,
                'processing' => $processing,
                'done'       => $done,
                'rejected'   => $rejected,
            ],
            'users'         => $users,
            'revenue'       => [
                'total'   => round($totalRevenue, 2),
                'week'    => round($weekRevenue, 2),
                'avg'     => round($avgValue, 2),
                'pending' => round(ServiceRequest::where('status', 'pending')->sum('price'), 2),
            ],
            'chart_last7'   => $last7,
            'top_services'  => $topServices,
        ]);
    }

    /* ══════════════════════════════
       USER Dashboard Stats
    ══════════════════════════════ */
    public function userStats(Request $request)
    {
        $user = $request->user();

        $total     = $user->requests()->count();
        $pending   = $user->requests()->where('status', 'pending')->count();
        $processing= $user->requests()->whereIn('status', ['processing','in_progress'])->count();
        $done      = $user->requests()->where('status', 'done')->count();
        $rejected  = $user->requests()->where('status', 'rejected')->count();

        $totalSpent = Payment::where('user_id', $user->id)
                             ->where('type', 'payment')
                             ->where('status', 'completed')
                             ->sum('amount');

        $recentRequests = $user->requests()
            ->with(['service', 'entity', 'logs'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn($r) => [
                'id'                   => $r->id,
                'ref_number'           => $r->ref_number,
                'status'               => $r->status,
                'status_label'         => $r->status_label,
                'service_name_ar'      => $r->service?->name_ar,
                'service_name_en'      => $r->service?->name_en,
                'entity_name_ar'       => $r->entity?->name_ar,
                'entity_name_en'       => $r->entity?->name_en,
                'icon'                 => $r->service?->icon,
                'color'                => $r->entity?->color,
                'price'                => $r->price,
                'estimated_completion' => $r->estimated_completion,
                'reject_reason'        => $r->reject_reason,
                'created_at'           => $r->created_at,
                'completed_at'         => $r->completed_at,
            ]);

        $recentPayments = Payment::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return response()->json([
            'user'    => [
                'id'                 => $user->id,
                'name'               => $user->name,
                'email'              => $user->email,
                'phone'              => $user->phone,
                'avatar_url'         => $user->avatar_url,
                'balance'            => $user->balance,
                'total_requests'     => $total,
                'completed_requests' => $done,
            ],
            'stats' => [
                'total'      => $total,
                'pending'    => $pending,
                'processing' => $processing,
                'done'       => $done,
                'rejected'   => $rejected,
                'total_spent'=> round($totalSpent, 2),
            ],
            'recent_requests' => $recentRequests,
            'recent_payments' => $recentPayments,
        ]);
    }
}

/* ════════════════════════════════════════════════════════
   PaymentController
════════════════════════════════════════════════════════ */

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /* ── User: charge balance ── */
    public function charge(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10|max:100000',
        ]);

        $user = $request->user();

        // In real app: integrate with payment gateway (Moyasar, HyperPay, etc.)
        // For now: simulate successful charge
        $user->increment('balance', $request->amount);

        $payment = Payment::create([
            'user_id'        => $user->id,
            'amount'         => $request->amount,
            'type'           => 'charge',
            'description_ar' => 'شحن رصيد: ' . $request->amount . ' ر.س',
            'description_en' => 'Balance top-up: ' . $request->amount . ' SAR',
            'status'         => 'completed',
            'transaction_ref'=> 'TXN-' . strtoupper(uniqid()),
        ]);

        return response()->json([
            'message' => 'تم شحن الرصيد بنجاح',
            'balance' => $user->fresh()->balance,
            'payment' => $payment,
        ]);
    }

    /* ── User: payment history ── */
    public function history(Request $request)
    {
        $payments = Payment::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return response()->json($payments);
    }

    /* ── Admin: all transactions ── */
    public function adminTransactions(Request $request)
    {
        if (!$request->user()?->isAdmin()) abort(403);

        $payments = Payment::with('user', 'request')
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json($payments);
    }
}
