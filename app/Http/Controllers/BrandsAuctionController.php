<?php

namespace App\Http\Controllers;

use App\Models\CommercialAgency;
use App\Models\FranchiseApplication;
use App\Models\FranchiseAuction;
use App\Models\FranchiseBid;
use App\Models\FranchiseBrand;
use App\Models\FranchiseOpportunity;
use App\Models\PageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandsAuctionController extends Controller
{
    public function index(Request $request)
    {
        $section = $request->get('section', 'franchise'); // franchise|agencies|brands|auctions

        $sliders = PageSlider::active()->get();

        // Platform stats
        $stats = [
            'opportunities' => FranchiseOpportunity::where('status', 'active')->count(),
            'agencies'      => CommercialAgency::where('status', 'active')->count(),
            'brands'        => FranchiseBrand::where('status', 'active')->count(),
            'auctions'      => FranchiseAuction::where('status', 'active')->where('ends_at', '>', now())->count(),
        ];

        // --- Franchise section ---
        $franchiseOpportunities = FranchiseOpportunity::with('steps')
            ->where('status', 'active')
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        // --- Agencies section ---
        $agencies = CommercialAgency::active()
            ->when($request->agency_category, fn($q) => $q->where('category', $request->agency_category))
            ->when($request->agency_type, fn($q) => $q->where('agency_type', $request->agency_type))
            ->get();

        // --- Brand sales section ---
        $brands = FranchiseBrand::with(['images', 'auctions'])
            ->where('status', 'active')
            ->when($request->brand_category, fn($q) => $q->where('category', $request->brand_category))
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        // --- Auctions section ---
        $activeAuctions = FranchiseAuction::with('brand')
            ->where('status', 'active')
            ->where('ends_at', '>', now())
            ->orderBy('ends_at')
            ->get();

        $endedAuctions = FranchiseAuction::with('brand')
            ->where('status', 'ended')
            ->orWhere(fn($q) => $q->where('status', 'active')->where('ends_at', '<=', now()))
            ->latest('ends_at')
            ->take(3)
            ->get();

        return view('brands_auction', compact(
            'section', 'sliders', 'stats',
            'franchiseOpportunities', 'agencies', 'brands',
            'activeAuctions', 'endedAuctions'
        ));
    }

    public function franchiseDetail(FranchiseOpportunity $opportunity)
    {
        if ($opportunity->status !== 'active') abort(404);
        $opportunity->load('steps');
        $related = FranchiseOpportunity::where('status', 'active')
            ->where('id', '!=', $opportunity->id)
            ->where('category', $opportunity->category)
            ->take(3)->get();
        return view('franchise_detail', compact('opportunity', 'related'));
    }

    public function brandDetail(FranchiseBrand $brand)
    {
        if ($brand->status !== 'active') abort(404);
        $brand->load(['images', 'auctions']);
        $activeAuction = $brand->activeAuction();
        $related = FranchiseBrand::where('status', 'active')
            ->where('id', '!=', $brand->id)
            ->where('category', $brand->category)
            ->take(3)->get();
        return view('brand_detail', compact('brand', 'activeAuction', 'related'));
    }

    public function agencyDetail(CommercialAgency $agency)
    {
        if ($agency->status !== 'active') abort(404);
        $related = CommercialAgency::where('status', 'active')
            ->where('id', '!=', $agency->id)
            ->where('category', $agency->category)
            ->take(3)->get();
        return view('agency_detail', compact('agency', 'related'));
    }

    public function show(FranchiseAuction $auction)
    {
        $auction->load(['brand.images', 'bids.user']);

        if (!$auction->isActive() && $auction->status !== 'ended') {
            abort(404);
        }

        $myBid = Auth::check()
            ? $auction->bids()->where('user_id', Auth::id())->latest()->first()
            : null;

        return view('auction_detail', compact('auction', 'myBid'));
    }

    public function bid(Request $request, FranchiseAuction $auction)
    {
        if (!$auction->isActive()) {
            return back()->withErrors(['amount' => 'المزاد لم يعد نشطاً.']);
        }

        $minBid = $auction->minNextBid();

        $request->validate([
            'amount' => ['required', 'integer', "min:$minBid"],
        ], [
            'amount.min' => 'الحد الأدنى للمزايدة هو ' . number_format($minBid) . ' ريال.',
        ]);

        DB::transaction(function () use ($request, $auction) {
            FranchiseBid::where('auction_id', $auction->id)
                ->where('status', 'active')
                ->update(['status' => 'outbid']);

            FranchiseBid::create([
                'auction_id' => $auction->id,
                'user_id'    => Auth::id(),
                'amount'     => $request->amount,
                'status'     => 'active',
            ]);

            $auction->update([
                'current_bid' => $request->amount,
                'bids_count'  => $auction->bids_count + 1,
            ]);
        });

        return redirect()->route('brands.auction.show', $auction)
            ->with('bid_success', 'تم تسجيل مزايدتك بنجاح! أنت الآن في المقدمة.');
    }
}
