<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Hall;
use App\Models\Order;
use App\Models\PartnerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    // ── Helpers ───────────────────────────────────────────────────────────

    private function getCart(): Cart
    {
        return Cart::firstOrCreate(['user_id' => Auth::id()]);
    }

    // ── Cart CRUD ─────────────────────────────────────────────────────────

    public function index(): View
    {
        $cart = $this->getCart();
        $cart->load('items');
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'item_type'  => ['required', 'in:hall,service'],
            'item_id'    => ['required', 'integer', 'min:1'],
            'event_date' => ['nullable', 'date', 'after_or_equal:today'],
            'notes'      => ['nullable', 'string', 'max:500'],
        ]);

        [$label, $price] = $this->resolveItemDetails(
            $request->item_type,
            $request->item_id
        );

        $cart = $this->getCart();

        // Prevent duplicate
        $exists = $cart->items()
            ->where('item_type', $request->item_type)
            ->where('item_id', $request->item_id)
            ->exists();

        if ($exists) {
            return back()->with('cart_warning', 'هذا العنصر موجود مسبقاً في سلتك');
        }

        $cart->items()->create([
            'item_type'      => $request->item_type,
            'item_id'        => $request->item_id,
            'label'          => $label,
            'price_snapshot' => $price,
            'event_date'     => $request->event_date,
            'notes'          => $request->notes,
        ]);

        return back()->with('cart_success', 'تمت إضافة "' . $label . '" إلى سلتك');
    }

    public function remove(CartItem $item): RedirectResponse
    {
        abort_unless($item->cart->user_id === Auth::id(), 403);
        $item->delete();
        return back()->with('success', 'تم حذف العنصر من السلة');
    }

    public function clear(): RedirectResponse
    {
        $this->getCart()->items()->delete();
        return back()->with('success', 'تم تفريغ السلة');
    }

    // ── Checkout ──────────────────────────────────────────────────────────

    public function checkout(): View|RedirectResponse
    {
        $cart = $this->getCart();
        $cart->load('items');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'سلتك فارغة، أضف عناصر أولاً');
        }

        $bankInfo = config('payment');
        return view('cart.checkout', compact('cart', 'bankInfo'));
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $request->validate([
            'payment_method' => ['required', 'in:bank_transfer'],
            'receipt'        => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $cart = $this->getCart();
        $cart->load('items');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'سلتك فارغة');
        }

        $receiptPath = $request->file('receipt')->store('orders/receipts', 'public');

        $orderNumber = 'ORD-' . date('Y') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'order_number'       => $orderNumber,
            'user_id'            => Auth::id(),
            'total_amount'       => $cart->items->sum('price_snapshot'),
            'status'             => 'receipt_uploaded',
            'payment_method'     => $request->payment_method,
            'receipt_path'       => $receiptPath,
            'bank_info_snapshot' => config('payment'),
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'item_type'      => $item->item_type,
                'item_id'        => $item->item_id,
                'label'          => $item->label,
                'price_snapshot' => $item->price_snapshot,
                'event_date'     => $item->event_date,
                'notes'          => $item->notes,
            ]);
        }

        // Clear cart after checkout
        $cart->items()->delete();

        return redirect()->route('cart.confirmation', $order)
            ->with('success', 'تم إرسال طلبك بنجاح! سنتواصل معك بعد مراجعة الإيصال.');
    }

    public function confirmation(Order $order): View
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('items');
        return view('cart.confirmation', compact('order'));
    }

    // ── Private Helpers ───────────────────────────────────────────────────

    private function resolveItemDetails(string $type, int $id): array
    {
        if ($type === 'hall') {
            $hall  = Hall::findOrFail($id);
            return [$hall->name, (float) $hall->price_per_day];
        }

        $service = PartnerService::with('partner')->findOrFail($id);
        $label   = $service->partner->company_name . ' — ' . $service->title;
        return [$label, (float) ($service->price ?? 0)];
    }
}
