<?php

namespace App\Http\Controllers;

use App\Models\FeesContent;
use Illuminate\Http\Request;

class FeesContentController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'intro_content' => ['nullable', 'string'],
        ]);

        $feesContent = FeesContent::instance();
        $feesContent->update(['intro_content' => $request->input('intro_content')]);

        return redirect()->route('dashboard', ['panel' => 'fees'])
            ->with('fees_content_success', 'Fees page content saved successfully.');
    }
}
