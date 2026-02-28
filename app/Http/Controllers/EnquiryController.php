<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /** Public: save enquiry from contact form */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Enquiry::create($request->only('name', 'email', 'phone', 'subject', 'message'));

        return redirect()->route('thank-you');
    }

    /** Protected: mark a single enquiry as read */
    public function markRead(Enquiry $enquiry)
    {
        $enquiry->update(['is_read' => true]);
        return back()->with('enquiry_success', 'Marked as read.');
    }

    /** Protected: delete an enquiry */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return back()->with('enquiry_success', 'Enquiry deleted.');
    }
}
