<?php

namespace App\Http\Controllers;

use App\Models\PageSeo;
use Illuminate\Http\Request;

class PageSeoController extends Controller
{
    public function update(Request $request, string $page)
    {
        $allowed = ['courses', 'gallery', 'blog', 'fees', 'contact'];
        if (!in_array($page, $allowed)) {
            abort(404);
        }

        $request->validate([
            'meta_title'       => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string'],
        ]);

        PageSeo::for($page)->update($request->only('meta_title', 'meta_description', 'meta_keywords'));

        // Map page to dashboard panel
        $panel = match($page) {
            'fees'    => 'fees',
            'contact' => 'seo',
            default   => $page,
        };

        return redirect()->route('dashboard', ['panel' => $panel])
            ->with("{$page}_seo_success", 'SEO settings saved successfully.');
    }
}
