<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    /* ── Create Form ─────────────────────────────────────────── */
    public function create()
    {
        return view('backend.blog.create');
    }

    /* ── Store ───────────────────────────────────────────────── */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:80',
            'meta_description' => 'nullable|string|max:165',
            'meta_keywords'    => 'nullable|string|max:255',
            'category'         => 'required|string|max:100',
            'author'           => 'required|string|max:100',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'nullable|string',
            'image'            => 'nullable|image|max:2048',
            'is_published'     => 'nullable|boolean',
        ]);

        $customSlug = $request->filled('slug') ? \Illuminate\Support\Str::slug($request->input('slug')) : null;
        $data['slug']         = $customSlug ?: BlogPost::generateSlug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('dashboard', ['panel' => 'blog'])
            ->with('blog_success', 'Blog post created successfully.');
    }

    /* ── Edit Form ───────────────────────────────────────────── */
    public function edit(BlogPost $blog)
    {
        return view('backend.blog.edit', compact('blog'));
    }

    /* ── Update ──────────────────────────────────────────────── */
    public function update(Request $request, BlogPost $blog)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:80',
            'meta_description' => 'nullable|string|max:165',
            'meta_keywords'    => 'nullable|string|max:255',
            'category'         => 'required|string|max:100',
            'author'           => 'required|string|max:100',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'nullable|string',
            'image'            => 'nullable|image|max:2048',
            'is_published'     => 'nullable|boolean',
        ]);

        $customSlug = $request->filled('slug') ? \Illuminate\Support\Str::slug($request->input('slug')) : null;
        $data['slug'] = $customSlug ?: BlogPost::generateSlug($data['title'], $blog->id);

        $wasPublished = $blog->is_published;
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && ! $wasPublished) {
            $data['published_at'] = now();
        } elseif (! $data['is_published']) {
            $data['published_at'] = null;
        }

        if ($request->hasFile('image')) {
            if ($blog->image) Storage::disk('public')->delete($blog->image);
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $blog->update($data);

        return redirect()->route('dashboard', ['panel' => 'blog'])
            ->with('blog_success', 'Blog post updated successfully.');
    }

    /* ── Destroy ─────────────────────────────────────────────── */
    public function destroy(BlogPost $blog)
    {
        if ($blog->image) Storage::disk('public')->delete($blog->image);
        $blog->delete();

        return redirect()->route('dashboard', ['panel' => 'blog'])
            ->with('blog_success', 'Blog post deleted.');
    }
}
