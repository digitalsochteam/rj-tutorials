<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create()
    {
        $type = request('type', 'image');
        return view('backend.gallery.create', compact('type'));
    }

    private function resolveCategory(Request $request): string
    {
        $cat = $request->input('category', 'General');
        if ($cat === '__other__') {
            $cat = trim($request->input('category_custom', 'General')) ?: 'General';
        }
        return $cat;
    }

    public function store(Request $request)
    {
        $request->merge(['category' => $this->resolveCategory($request)]);
        $isVideo = $request->input('media_type') === 'video';

        if ($isVideo) {
            $videoSource = $request->input('video_source', 'file'); // 'file' or 'url'

            if ($videoSource === 'file') {
                $data = $request->validate([
                    'title'      => 'required|string|max:255',
                    'category'   => 'required|string|max:100',
                    'video_file' => 'required|file|mimes:mp4,webm,ogg,mov,avi|max:102400',
                    'image'      => 'nullable|image|max:3072',
                    'sort_order' => 'nullable|integer|min:0',
                    'is_active'  => 'nullable|boolean',
                ]);
                $data['media_type'] = 'video';
                $data['video_file'] = $request->file('video_file')->store('gallery/videos', 'public');
                $data['video_url']  = null;
                $data['image']      = $request->hasFile('image')
                    ? $request->file('image')->store('gallery', 'public')
                    : null;
            } else {
                $data = $request->validate([
                    'title'      => 'required|string|max:255',
                    'category'   => 'required|string|max:100',
                    'video_url'  => 'required|url|max:500',
                    'image'      => 'nullable|image|max:3072',
                    'sort_order' => 'nullable|integer|min:0',
                    'is_active'  => 'nullable|boolean',
                ]);
                $data['media_type'] = 'video';
                $data['video_file'] = null;
                $data['image']      = $request->hasFile('image')
                    ? $request->file('image')->store('gallery', 'public')
                    : null;
            }
        } else {
            $request->validate([
                'title'      => 'required|string|max:255',
                'category'   => 'required|string|max:100',
                'images'     => 'required|array|min:1',
                'images.*'   => 'image|max:3072',
                'sort_order' => 'nullable|integer|min:0',
                'is_active'  => 'nullable|boolean',
            ]);

            $isActive  = $request->boolean('is_active', true);
            $sortOrder = $request->input('sort_order', 0);
            $count     = 0;

            foreach ($request->file('images') as $file) {
                GalleryImage::create([
                    'title'      => $request->input('title'),
                    'category'   => $request->input('category'),
                    'media_type' => 'image',
                    'image'      => $file->store('gallery', 'public'),
                    'video_url'  => null,
                    'video_file' => null,
                    'is_active'  => $isActive,
                    'sort_order' => $sortOrder,
                ]);
                $count++;
            }

            return redirect()->route('dashboard', ['panel' => 'gallery'])
                ->with('gallery_success', $count === 1 ? 'Image uploaded successfully.' : "$count images uploaded successfully.");
        }

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        GalleryImage::create($data);

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', 'Video added successfully.');
    }

    public function edit(GalleryImage $gallery)
    {
        return view('backend.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $request->merge(['category' => $this->resolveCategory($request)]);
        $isVideo = $request->input('media_type') === 'video';

        if ($isVideo) {
            $videoSource = $request->input('video_source', $gallery->video_file ? 'file' : 'url');

            if ($videoSource === 'file') {
                $data = $request->validate([
                    'title'      => 'required|string|max:255',
                    'category'   => 'required|string|max:100',
                    'video_file' => 'nullable|file|mimes:mp4,webm,ogg,mov,avi|max:102400',
                    'image'      => 'nullable|image|max:3072',
                    'sort_order' => 'nullable|integer|min:0',
                    'is_active'  => 'nullable|boolean',
                ]);
                $data['media_type'] = 'video';
                $data['video_url']  = null;

                if ($request->hasFile('video_file')) {
                    if ($gallery->video_file) Storage::disk('public')->delete($gallery->video_file);
                    $data['video_file'] = $request->file('video_file')->store('gallery/videos', 'public');
                } else {
                    unset($data['video_file']); // keep existing
                }

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
                    'video_url'  => 'required|url|max:500',
                    'image'      => 'nullable|image|max:3072',
                    'sort_order' => 'nullable|integer|min:0',
                    'is_active'  => 'nullable|boolean',
                ]);
                $data['media_type'] = 'video';

                // Delete old local video file if switching to URL
                if ($gallery->video_file) {
                    Storage::disk('public')->delete($gallery->video_file);
                    $data['video_file'] = null;
                }

                if ($request->hasFile('image')) {
                    if ($gallery->image) Storage::disk('public')->delete($gallery->image);
                    $data['image'] = $request->file('image')->store('gallery', 'public');
                } else {
                    unset($data['image']);
                }
            }
        } else {
            $data = $request->validate([
                'title'      => 'required|string|max:255',
                'category'   => 'required|string|max:100',
                'image'      => 'nullable|image|max:3072',
                'sort_order' => 'nullable|integer|min:0',
                'is_active'  => 'nullable|boolean',
            ]);
            $data['media_type'] = 'image';
            $data['video_url']  = null;
            $data['video_file'] = null;

            if ($gallery->video_file) Storage::disk('public')->delete($gallery->video_file);

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
        if ($gallery->image)      Storage::disk('public')->delete($gallery->image);
        if ($gallery->video_file) Storage::disk('public')->delete($gallery->video_file);
        $gallery->delete();

        return redirect()->route('dashboard', ['panel' => 'gallery'])
            ->with('gallery_success', 'Item deleted successfully.');
    }
}