<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\FranchiseBrand;
use App\Models\FranchiseBrandImage;
use App\Models\FranchiseAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FranchiseBrandController extends Controller
{
    public function index()
    {
        $brands = FranchiseBrand::with('images')->orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('supervisor.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('supervisor.brands.form', ['brand' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $brand = FranchiseBrand::create($data);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('franchise/logos', 'public');
            $brand->update(['logo' => $path]);
        }

        $this->storeImages($request, $brand);
        $this->handleAuction($request, $brand);

        return redirect()->route('supervisor.brands.index')
            ->with('success', 'تم إضافة العلامة التجارية بنجاح.');
    }

    public function edit(FranchiseBrand $brand)
    {
        $brand->load(['images', 'auctions']);
        return view('supervisor.brands.form', compact('brand'));
    }

    public function update(Request $request, FranchiseBrand $brand)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            if ($brand->logo) Storage::disk('public')->delete($brand->logo);
            $data['logo'] = $request->file('logo')->store('franchise/logos', 'public');
        }

        $brand->update($data);
        $this->storeImages($request, $brand);
        $this->handleAuction($request, $brand);

        return redirect()->route('supervisor.brands.index')
            ->with('success', 'تم تحديث العلامة التجارية.');
    }

    public function destroy(FranchiseBrand $brand)
    {
        if ($brand->logo) Storage::disk('public')->delete($brand->logo);
        foreach ($brand->images as $img) {
            Storage::disk('public')->delete($img->path);
        }
        $brand->delete();
        return back()->with('success', 'تم حذف العلامة التجارية.');
    }

    public function deleteImage(FranchiseBrandImage $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return back()->with('success', 'تم حذف الصورة.');
    }

    // ── helpers ──────────────────────────────────────────────────────────────────

    private function validated(Request $request): array
    {
        $request->validate([
            'name'                 => ['required', 'string', 'max:150'],
            'name_en'              => ['nullable', 'string', 'max:150'],
            'category'             => ['required', 'string'],
            'description'          => ['nullable', 'string'],
            'investment_min'       => ['required', 'integer', 'min:0'],
            'investment_max'       => ['required', 'integer', 'gte:investment_min'],
            'roi_months_min'       => ['required', 'integer', 'min:1'],
            'roi_months_max'       => ['required', 'integer', 'gte:roi_months_min'],
            'franchise_fee_percent'=> ['required', 'numeric', 'min:0', 'max:100'],
            'available_regions'    => ['nullable', 'array'],
            'requirements'         => ['nullable', 'string'],
            'status'               => ['required', 'in:active,inactive,draft'],
            'is_featured'          => ['sometimes', 'boolean'],
            'is_auction_eligible'  => ['sometimes', 'boolean'],
            'sort_order'           => ['nullable', 'integer'],
        ]);

        $data = $request->only([
            'name', 'name_en', 'category', 'subcategory', 'description', 'description_en',
            'investment_min', 'investment_max', 'roi_months_min', 'roi_months_max',
            'franchise_fee_percent', 'status', 'sort_order',
        ]);

        $data['available_regions']   = $request->input('available_regions', []);
        $data['requirements']        = $request->input('requirements') ? array_filter(explode("\n", $request->input('requirements'))) : [];
        $data['is_featured']         = $request->boolean('is_featured');
        $data['is_auction_eligible'] = $request->boolean('is_auction_eligible');

        return $data;
    }

    private function storeImages(Request $request, FranchiseBrand $brand): void
    {
        if (!$request->hasFile('images')) return;

        foreach ($request->file('images') as $i => $file) {
            $path = $file->store('franchise/images', 'public');
            $brand->images()->create([
                'path'       => $path,
                'caption'    => $request->input("image_captions.$i"),
                'sort_order' => $i,
                'is_primary' => $i === 0 && $brand->images()->count() === 1,
            ]);
        }
    }

    private function handleAuction(Request $request, FranchiseBrand $brand): void
    {
        if (!$request->boolean('create_auction')) return;

        $request->validate([
            'auction_starting_bid' => ['required', 'integer', 'min:1000'],
            'auction_ends_at'      => ['required', 'date', 'after:now'],
            'auction_deposit'      => ['required', 'integer', 'min:500'],
            'auction_increment'    => ['required', 'integer', 'min:500'],
        ]);

        FranchiseAuction::create([
            'brand_id'        => $brand->id,
            'title'           => 'مزاد ' . $brand->name,
            'starting_bid'    => $request->auction_starting_bid,
            'current_bid'     => $request->auction_starting_bid,
            'deposit_amount'  => $request->auction_deposit,
            'increment_amount'=> $request->auction_increment,
            'status'          => 'active',
            'starts_at'       => now(),
            'ends_at'         => $request->auction_ends_at,
        ]);
    }
}
