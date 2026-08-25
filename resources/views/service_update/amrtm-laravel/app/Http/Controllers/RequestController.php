<?php
// app/Http/Controllers/RequestController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\RequestLog;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    /* ══════════════════════════════
       USER — Submit new request
    ══════════════════════════════ */
    public function store(Request $request)
    {
        $request->validate([
            'service_id'       => 'required|exists:services,id',
            'client_name'      => 'required|string|max:255',
            'client_email'     => 'required|email',
            'client_phone'     => 'required|string',
            'client_id_number' => 'required|string',
            'company_name'     => 'nullable|string',
            'company_cr'       => 'nullable|string',
            'notes'            => 'nullable|string',
            'attachments.*'    => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $user    = $request->user();
        $service = Service::with('entity')->findOrFail($request->service_id);

        // Check balance
        if ($user->balance < $service->price) {
            return response()->json([
                'message' => 'الرصيد غير كافٍ، يرجى شحن رصيدك أولاً',
                'required' => $service->price,
                'balance'  => $user->balance,
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('requests/attachments', 'public');
                    $attachments[] = [
                        'path' => $path,
                        'url'  => Storage::url($path),
                        'name' => $file->getClientOriginalName(),
                    ];
                }
            }

            // Create request
            $sr = ServiceRequest::create([
                'user_id'          => $user->id,
                'service_id'       => $service->id,
                'entity_id'        => $service->entity->id,
                'client_name'      => $request->client_name,
                'client_email'     => $request->client_email,
                'client_phone'     => $request->client_phone,
                'client_id_number' => $request->client_id_number,
                'company_name'     => $request->company_name,
                'company_cr'       => $request->company_cr,
                'notes'            => $request->notes,
                'attachments'      => $attachments,
                'price'            => $service->price,
                'status'           => 'pending',
                'estimated_completion' => $service->estimated_days . ' أيام عمل',
            ]);

            // Deduct balance
            $user->decrement('balance', $service->price);

            // Create payment record
            Payment::create([
                'user_id'        => $user->id,
                'request_id'     => $sr->id,
                'amount'         => $service->price,
                'type'           => 'payment',
                'description_ar' => 'دفع خدمة: ' . $service->name_ar,
                'description_en' => 'Service payment: ' . $service->name_en,
                'status'         => 'completed',
            ]);

            // Log
            RequestLog::create([
                'request_id' => $sr->id,
                'user_id'    => $user->id,
                'status'     => 'pending',
                'note'       => 'تم استلام الطلب',
            ]);

            DB::commit();

            return response()->json([
                'message'    => 'تم تقديم الطلب بنجاح',
                'ref_number' => $sr->ref_number,
                'request'    => $this->requestResource($sr),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'حدث خطأ: ' . $e->getMessage()], 500);
        }
    }

    /* ══════════════════════════════
       USER — My requests
    ══════════════════════════════ */
    public function myRequests(Request $request)
    {
        $requests = ServiceRequest::with(['service', 'entity', 'logs'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'data' => $requests->items(),
            'meta' => [
                'total'        => $requests->total(),
                'current_page' => $requests->currentPage(),
                'last_page'    => $requests->lastPage(),
            ],
        ]);
    }

    /* ── User single request ── */
    public function show(Request $request, $id)
    {
        $sr = ServiceRequest::with(['service', 'entity.category', 'logs'])
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);
        return response()->json($this->requestResource($sr));
    }

    /* ══════════════════════════════
       ADMIN — All requests
    ══════════════════════════════ */
    public function adminIndex(Request $request)
    {
        $this->adminOnly($request);

        $q = ServiceRequest::with(['service', 'entity', 'user', 'logs'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->status && $request->status !== 'all') {
            $q->where('status', $request->status);
        }

        // Search
        if ($request->search) {
            $q->where(function ($query) use ($request) {
                $query->where('ref_number', 'like', '%' . $request->search . '%')
                      ->orWhere('client_name', 'like', '%' . $request->search . '%')
                      ->orWhere('client_email', 'like', '%' . $request->search . '%')
                      ->orWhere('client_phone', 'like', '%' . $request->search . '%');
            });
        }

        $requests = $q->paginate(20);

        return response()->json([
            'data' => collect($requests->items())->map(fn($r) => $this->requestResource($r)),
            'meta' => [
                'total'    => $requests->total(),
                'page'     => $requests->currentPage(),
                'lastPage' => $requests->lastPage(),
            ],
        ]);
    }

    /* ── Admin: update status ── */
    public function updateStatus(Request $request, $id)
    {
        $this->adminOnly($request);

        $request->validate([
            'status'                => 'required|in:pending,processing,in_progress,done,rejected',
            'reject_reason'         => 'required_if:status,rejected|nullable|string',
            'estimated_completion'  => 'nullable|string',
        ]);

        $sr = ServiceRequest::with('user')->findOrFail($id);
        $old = $sr->status;

        $sr->update([
            'status'               => $request->status,
            'reject_reason'        => $request->reject_reason,
            'estimated_completion' => $request->estimated_completion ?? $sr->estimated_completion,
            'handled_by'           => $request->user()->id,
            'completed_at'         => $request->status === 'done' ? now() : null,
        ]);

        // Log
        RequestLog::create([
            'request_id' => $sr->id,
            'user_id'    => $request->user()->id,
            'status'     => $request->status,
            'note'       => $request->note ?? $this->defaultNote($request->status),
        ]);

        // Refund if rejected
        if ($request->status === 'rejected' && $old !== 'rejected') {
            $sr->user->increment('balance', $sr->price);
            Payment::create([
                'user_id'        => $sr->user_id,
                'request_id'     => $sr->id,
                'amount'         => $sr->price,
                'type'           => 'refund',
                'description_ar' => 'استرداد: طلب ' . $sr->ref_number,
                'description_en' => 'Refund: request ' . $sr->ref_number,
                'status'         => 'completed',
            ]);
        }

        return response()->json([
            'message' => 'تم تحديث الحالة',
            'request' => $this->requestResource($sr->fresh(['user', 'logs'])),
        ]);
    }

    /* ── Admin: set estimated time ── */
    public function setEstimatedTime(Request $request, $id)
    {
        $this->adminOnly($request);
        $request->validate(['estimated_completion' => 'required|string']);
        $sr = ServiceRequest::findOrFail($id);
        $sr->update(['estimated_completion' => $request->estimated_completion]);
        return response()->json(['message' => 'تم تحديث وقت الإنجاز']);
    }

    /* ══════════════════════════════
       HELPERS
    ══════════════════════════════ */
    private function requestResource(ServiceRequest $sr): array
    {
        return [
            'id'                   => $sr->id,
            'ref_number'           => $sr->ref_number,
            'status'               => $sr->status,
            'status_label'         => $sr->status_label,
            'price'                => $sr->price,
            'client_name'          => $sr->client_name,
            'client_email'         => $sr->client_email,
            'client_phone'         => $sr->client_phone,
            'client_id_number'     => $sr->client_id_number,
            'company_name'         => $sr->company_name,
            'company_cr'           => $sr->company_cr,
            'notes'                => $sr->notes,
            'attachments'          => $sr->attachments ?? [],
            'reject_reason'        => $sr->reject_reason,
            'estimated_completion' => $sr->estimated_completion,
            'completed_at'         => $sr->completed_at,
            'created_at'           => $sr->created_at,
            'service'              => $sr->relationLoaded('service') ? [
                'id'      => $sr->service->id,
                'name_ar' => $sr->service->name_ar,
                'name_en' => $sr->service->name_en,
                'icon'    => $sr->service->icon,
                'price'   => $sr->service->price,
            ] : null,
            'entity' => $sr->relationLoaded('entity') ? [
                'id'      => $sr->entity->id,
                'name_ar' => $sr->entity->name_ar,
                'name_en' => $sr->entity->name_en,
                'icon'    => $sr->entity->icon,
                'color'   => $sr->entity->color,
            ] : null,
            'user' => $sr->relationLoaded('user') ? [
                'id'         => $sr->user->id,
                'name'       => $sr->user->name,
                'email'      => $sr->user->email,
                'phone'      => $sr->user->phone,
                'avatar_url' => $sr->user->avatar_url,
            ] : null,
            'logs' => $sr->relationLoaded('logs') ? $sr->logs->map(fn($l) => [
                'status'     => $l->status,
                'note'       => $l->note,
                'created_at' => $l->created_at,
            ]) : [],
        ];
    }

    private function defaultNote(string $status): string
    {
        return match ($status) {
            'processing'  => 'جاري معالجة الطلب',
            'in_progress' => 'الطلب قيد التنفيذ',
            'done'        => 'تمت العملية بنجاح',
            'rejected'    => 'تم رفض الطلب',
            default       => 'تم تحديث الحالة',
        };
    }

    private function adminOnly(Request $request): void
    {
        if (!$request->user()?->isAdmin()) abort(403, 'غير مصرح');
    }
}
