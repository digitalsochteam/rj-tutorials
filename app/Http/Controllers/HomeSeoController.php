<?php

namespace App\Http\Controllers;

use App\Models\HomeSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSeoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:320'],
            'seo_keywords'    => ['nullable', 'string', 'max:500'],
            'og_image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $seo  = HomeSeo::instance();
        $data = $request->only('seo_title', 'seo_description', 'seo_keywords');

        if ($request->hasFile('og_image')) {
            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        $seo->update($data);

        return redirect()->route('dashboard', ['panel' => 'seo'])
            ->with('seo_success', 'SEO settings saved successfully.');
    }
}
