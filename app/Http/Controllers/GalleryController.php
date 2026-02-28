<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create()
    {
        return view('backend.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string|max:100',
            'caption'    => 'nullable|string|max:255',
            'image'      => 'required|image|max:3072',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        $data['image']      = $request->file('image')->store('gallery', 'public');
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        GalleryImage::create($data);

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', 'Image uploaded successfully.');
    }

    public function edit(GalleryImage $gallery)
    {
        return view('backend.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string|max:100',
            'caption'    => 'nullable|string|max:255',
            'image'      => 'nullable|image|max:3072',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($gallery->image) Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        } else {
            unset($data['image']);
        }

        $gallery->update($data);

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', 'Image updated successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        if ($gallery->image) Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', 'Image deleted successfully.');
    }
}
