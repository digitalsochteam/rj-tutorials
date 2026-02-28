<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create()
    {
        return view('backend.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'message'     => ['required', 'string'],
            'rating'      => ['nullable', 'integer', 'min:1', 'max:5'],
            'photo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['rating']     = $data['rating'] ?? 5;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;

        Testimonial::create($data);

        return redirect()->route('dashboard', ['panel' => 'testimonials'])
            ->with('testimonial_success', 'Testimonial added successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('backend.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'message'     => ['required', 'string'],
            'rating'      => ['nullable', 'integer', 'min:1', 'max:5'],
            'photo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                \Storage::disk('public')->delete($testimonial->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        } else {
            unset($data['photo']);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['rating']     = $data['rating'] ?? 5;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;

        $testimonial->update($data);

        return redirect()->route('dashboard', ['panel' => 'testimonials'])
            ->with('testimonial_success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            \Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();

        return redirect()->route('dashboard', ['panel' => 'testimonials'])
            ->with('testimonial_success', 'Testimonial deleted successfully!');
    }
}
