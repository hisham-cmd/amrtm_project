<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /* ══════════════════════════════
       PUBLIC — Get all categories with entities & services
    ══════════════════════════════ */
    public function index()
    {
        $categories = Category::with([
            'entities' => function ($q) {
                $q->where('is_active', true)
                  ->with(['services' => function ($sq) {
                      $sq->where('is_active', true)->orderBy('sort_order');
                  }])
                  ->orderBy('sort_order');
            }
        ])
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

        return response()->json($categories);
    }

    /* ── Get single entity with services ── */
    public function entity($id)
    {
        $entity = Entity::with(['services' => fn($q) => $q->where('is_active', true)->orderBy('sort_order'),
                                'category'])
                        ->findOrFail($id);
        return response()->json($entity);
    }

    /* ── Get single service ── */
    public function service($id)
    {
        $service = Service::with('entity.category')->findOrFail($id);
        return response()->json($service);
    }

    /* ══════════════════════════════
       ADMIN — Category CRUD
    ══════════════════════════════ */
    public function storeCategory(Request $request)
    {
        $this->adminOnly($request);
        $request->validate([
            'key'     => 'required|unique:categories,key',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'icon'    => 'required|string',
            'color'   => 'required|string',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function updateCategory(Request $request, $id)
    {
        $this->adminOnly($request);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    public function destroyCategory(Request $request, $id)
    {
        $this->adminOnly($request);
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'تم الحذف']);
    }

    /* ══════════════════════════════
       ADMIN — Entity CRUD
    ══════════════════════════════ */
    public function storeEntity(Request $request)
    {
        $this->adminOnly($request);
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ar'     => 'required|string',
            'name_en'     => 'required|string',
        ]);

        $entity = Entity::create($request->all());
        return response()->json($entity, 201);
    }

    public function updateEntity(Request $request, $id)
    {
        $this->adminOnly($request);
        $entity = Entity::findOrFail($id);
        $entity->update($request->all());
        return response()->json($entity);
    }

    public function destroyEntity(Request $request, $id)
    {
        $this->adminOnly($request);
        Entity::findOrFail($id)->delete();
        return response()->json(['message' => 'تم الحذف']);
    }

    /* ══════════════════════════════
       ADMIN — Service CRUD + Pricing
    ══════════════════════════════ */
    public function storeService(Request $request)
    {
        $this->adminOnly($request);
        $request->validate([
            'entity_id'      => 'required|exists:entities,id',
            'name_ar'        => 'required|string',
            'name_en'        => 'required|string',
            'price'          => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
        ]);

        $service = Service::create($request->all());
        return response()->json($service, 201);
    }

    public function updateService(Request $request, $id)
    {
        $this->adminOnly($request);
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return response()->json($service);
    }

    /* ── Update price only ── */
    public function updatePrice(Request $request, $id)
    {
        $this->adminOnly($request);
        $request->validate(['price' => 'required|numeric|min:0']);
        $service = Service::findOrFail($id);
        $service->update(['price' => $request->price]);
        return response()->json(['message' => 'تم تحديث السعر', 'price' => $service->price]);
    }

    public function destroyService(Request $request, $id)
    {
        $this->adminOnly($request);
        Service::findOrFail($id)->delete();
        return response()->json(['message' => 'تم الحذف']);
    }

    /* ── Helper ── */
    private function adminOnly(Request $request)
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            abort(403, 'غير مصرح');
        }
    }
}
