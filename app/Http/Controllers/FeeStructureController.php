<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function create()
    {
        return view('backend.fees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_name'    => ['required', 'string', 'max:255'],
            'type'           => ['required', 'string', 'max:255'],
            'fees'           => ['nullable', 'numeric', 'min:0'],
            'discount'       => ['nullable', 'numeric', 'min:0'],
            'after_discount' => ['nullable', 'numeric', 'min:0'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;

        FeeStructure::create($data);

        return redirect()->route('dashboard', ['panel' => 'fees'])
            ->with('fees_success', 'Fee entry added successfully!');
    }

    public function edit(FeeStructure $fee)
    {
        return view('backend.fees.edit', compact('fee'));
    }

    public function update(Request $request, FeeStructure $fee)
    {
        $data = $request->validate([
            'course_name'    => ['required', 'string', 'max:255'],
            'type'           => ['required', 'string', 'max:255'],
            'fees'           => ['nullable', 'numeric', 'min:0'],
            'discount'       => ['nullable', 'numeric', 'min:0'],
            'after_discount' => ['nullable', 'numeric', 'min:0'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;

        $fee->update($data);

        return redirect()->route('dashboard', ['panel' => 'fees'])
            ->with('fees_success', 'Fee entry updated successfully!');
    }

    public function destroy(FeeStructure $fee)
    {
        $fee->delete();

        return redirect()->route('dashboard', ['panel' => 'fees'])
            ->with('fees_success', 'Fee entry deleted successfully!');
    }
}
