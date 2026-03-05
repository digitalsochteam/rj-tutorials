<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create()
    {
        $type = request('type', 'image'); // 'image' or 'video'
        return view('backend.gallery.create', compact('type'));
    }

    public function store(Request $request)
    {
        $isVideo = $request->input('media_type') === 'video';

        if ($isVideo) {
            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'category'   => 'required|string|max:100',
                'caption'    => 'nullable|string|max:255',
                'video_url'  => 'required|url|max:500',
                'image'      => 'nullable|image|max:3072',
                'sort_order' => 'nullable|integer|min:0',
                'is_active'  => 'nullable|boolean',
            ]);
            $data['media_type'] = 'video';
            $data['image']      = $request->hasFile('image')
                ? $request->file('image')->store('gallery', 'public')
                : null;
        } else {
            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'category'   => 'required|string|max:100',
                'caption'    => 'nullable|string|max:255',
                'image'      => 'required|image|max:3072',
                'sort_order' => 'nullable|integer|min:0',
                'is_active'  => 'nullable|boolean',
            ]);
            $data['media_type'] = 'image';
            $data['image']      = $request->file('image')->store('gallery', 'public');
            $data['video_url']  = null;
        }

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        GalleryImage::create($data);

        $msg = $isVideo ? 'Video added successfully.' : 'Image uploaded successfully.';
        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', $msg);
    }

    public function edit(GalleryImage $gallery)
    {
        return view('backend.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $isVideo = $request->input('media_type') === 'video';

        if ($isVideo) {
            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'category'   => 'required|string|max:100',
                'caption'    => 'nullable|string|max:255',
                'video_url'  => 'required|url|max:500',
                'image'      => 'nullable|image|max:3072',
                'sort_order' => 'nullable|integer|min:0',
                'is_active'  => 'nullable|boolean',
            ]);
            $data['media_type'] = 'video';

            if ($request->hasFile('image')) {
                if ($gallery->image) Storage::disk('public')->delete($gallery->image);
                $data['image'] = $request->file('image')->store('gallery', 'public');
            } else {
                unset($data['image']);
            }
        } else {
            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'category'   => 'required|string|max:100',
                'caption'    => 'nullable|string|max:255',
                'image'      => 'nullable|image|max:3072',
                'sort_order' => 'nullable|integer|min:0',
                'is_active'  => 'nullable|boolean',
            ]);
            $data['media_type'] = 'image';
            $data['video_url']  = null;

            if ($request->hasFile('image')) {
                if ($gallery->image) Storage::disk('public')->delete($gallery->image);
                $data['image'] = $request->file('image')->store('gallery', 'public');
            } else {
                unset($data['image']);
            }
        }

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        $gallery->update($data);

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', $isVideo ? 'Video updated successfully.' : 'Image updated successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        if ($gallery->image) Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', 'Item deleted successfully.');
    }
}
