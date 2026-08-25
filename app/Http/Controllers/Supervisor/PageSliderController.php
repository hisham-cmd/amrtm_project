<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\PageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSliderController extends Controller
{
    public function index()
    {
        $sliders = PageSlider::orderBy('sort_order')->get();
        return view('supervisor.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('supervisor.sliders.form', ['slider' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'image'      => 'required|image|max:4096',
            'link_url'   => 'nullable|string|max:500',
            'link_text'  => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        $data['image_path'] = $request->file('image')->store('sliders', 'public');
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        unset($data['image']);

        PageSlider::create($data);
        return redirect()->route('supervisor.sliders.index')->with('success', 'تمت إضافة الصورة بنجاح.');
    }

    public function edit(PageSlider $slider)
    {
        return view('supervisor.sliders.form', compact('slider'));
    }

    public function update(Request $request, PageSlider $slider)
    {
        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'image'      => 'nullable|image|max:4096',
            'link_url'   => 'nullable|string|max:500',
            'link_text'  => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image_path);
            $data['image_path'] = $request->file('image')->store('sliders', 'public');
        }
        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? $slider->sort_order;
        unset($data['image']);

        $slider->update($data);
        return redirect()->route('supervisor.sliders.index')->with('success', 'تم تحديث الصورة.');
    }

    public function destroy(PageSlider $slider)
    {
        Storage::disk('public')->delete($slider->image_path);
        $slider->delete();
        return redirect()->route('supervisor.sliders.index')->with('success', 'تم حذف الصورة.');
    }

    public function toggle(PageSlider $slider)
    {
        $slider->update(['is_active' => !$slider->is_active]);
        return back()->with('success', 'تم تغيير حالة الصورة.');
    }
}
