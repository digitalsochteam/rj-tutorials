<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function create()
    {
        return view('backend.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255',
            'meta_title'        => 'nullable|string',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string',
            'category'          => 'required|string|max:100',
            'tagline'           => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|max:2048',
            'sort_order'        => 'nullable|integer|min:0',
            'is_active'         => 'nullable|boolean',
        ]);

        $customSlug = $request->filled('slug') ? \Illuminate\Support\Str::slug($request->input('slug')) : null;
        $data['slug']      = $customSlug ?: Course::generateSlug($data['title']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('dashboard', ['panel' => 'courses'])
            ->with('courses_success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return view('backend.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255',
            'meta_title'        => 'nullable|string',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string',
            'category'          => 'required|string|max:100',
            'tagline'           => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|max:2048',
            'sort_order'        => 'nullable|integer|min:0',
            'is_active'         => 'nullable|boolean',
        ]);

        $customSlug = $request->filled('slug') ? \Illuminate\Support\Str::slug($request->input('slug')) : null;
        $data['slug']      = $customSlug ?: Course::generateSlug($data['title'], $course->id);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($course->image) Storage::disk('public')->delete($course->image);
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('dashboard', ['panel' => 'courses'])
            ->with('courses_success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->image) Storage::disk('public')->delete($course->image);
        $course->delete();

        return redirect()->route('dashboard', ['panel' => 'courses'])
            ->with('courses_success', 'Course deleted.');
    }
}
