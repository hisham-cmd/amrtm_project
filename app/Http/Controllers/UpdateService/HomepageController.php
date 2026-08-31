<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use App\Models\HomepageSlide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function page()
    {
        return view('update_service.admin_homepage');
    }

    public function getSettings(): JsonResponse
    {
        $settings = HomepageSetting::all()->pluck('value', 'key');
        return response()->json(['success' => true, 'settings' => $settings]);
    }

    public function saveSettings(Request $request): JsonResponse
    {
        $data = $request->except(['_token']);
        foreach ($data as $key => $value) {
            HomepageSetting::set($key, is_array($value) ? json_encode($value) : (string)$value);
        }
        return response()->json(['success' => true, 'message' => 'تم حفظ الإعدادات بنجاح']);
    }

    public function listSlides(): JsonResponse
    {
        $slides = HomepageSlide::orderBy('sort_order')->get();
        return response()->json(['success' => true, 'slides' => $slides]);
    }

    public function storeSlide(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'      => 'nullable|string|max:255',
            'image'      => 'required|file|image|max:5120',
            'link_url'   => 'nullable|string|max:500',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('homepage/slides', 'public');

        $slide = HomepageSlide::create([
            'title'      => $validated['title'] ?? null,
            'image_path' => $path,
            'link_url'   => $validated['link_url'] ?? null,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? (HomepageSlide::max('sort_order') + 1),
        ]);

        return response()->json(['success' => true, 'slide' => $slide], 201);
    }

    public function reorderSlides(Request $request): JsonResponse
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->input('order') as $index => $id) {
            HomepageSlide::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }

    public function updateSlide(Request $request, int $id): JsonResponse
    {
        $slide = HomepageSlide::findOrFail($id);
        $validated = $request->validate([
            'title'      => 'nullable|string|max:255',
            'image'      => 'nullable|file|image|max:5120',
            'link_url'   => 'nullable|string|max:500',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('homepage/slides', 'public');
            $slide->image_path = $path;
        }

        if (array_key_exists('title', $validated)) {
            $slide->title = $validated['title'];
        }
        if (array_key_exists('link_url', $validated)) {
            $slide->link_url = $validated['link_url'];
        }
        if ($request->has('is_active')) {
            $slide->is_active = $request->boolean('is_active');
        }
        if (array_key_exists('sort_order', $validated)) {
            $slide->sort_order = $validated['sort_order'];
        }

        $slide->save();
        return response()->json(['success' => true, 'slide' => $slide]);
    }

    public function toggleSlide(int $id): JsonResponse
    {
        $slide = HomepageSlide::findOrFail($id);
        $slide->is_active = !$slide->is_active;
        $slide->save();
        return response()->json(['success' => true, 'is_active' => $slide->is_active]);
    }

    public function deleteSlide(int $id): JsonResponse
    {
        $slide = HomepageSlide::findOrFail($id);
        if ($slide->image_path && !str_starts_with($slide->image_path, 'images/')) {
            Storage::disk('public')->delete($slide->image_path);
        }
        $slide->delete();
        return response()->json(['success' => true]);
    }
}
