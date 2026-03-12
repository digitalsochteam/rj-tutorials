<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function edit()
    {
        $about = AboutUs::instance();
        return view('backend.about_us.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'tagline'          => ['required', 'string', 'max:255'],
            'title'            => ['required', 'string', 'max:255'],
            'paragraph_1'      => ['nullable', 'string'],
            'paragraph_2'      => ['nullable', 'string'],
            'paragraph_3'      => ['nullable', 'string'],
            'main_image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'secondary_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'years_experience' => ['required', 'integer', 'min:0'],
            'students_count'   => ['required', 'integer', 'min:0'],
            'meta_title'       => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string'],
        ]);

        $about = AboutUs::instance();

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')
                ->store('about', 'public');
        } else {
            unset($data['main_image']);
        }

        // Handle secondary image upload
        if ($request->hasFile('secondary_image')) {
            $data['secondary_image'] = $request->file('secondary_image')
                ->store('about', 'public');
        } else {
            unset($data['secondary_image']);
        }

        $about->update($data);

        return redirect()->route('dashboard', ['panel' => 'about'])
            ->with('success', 'About Us section updated successfully!');
    }
}
