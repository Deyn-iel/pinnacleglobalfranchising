<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'message' => 'required|string',
    ]);

    Contact::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'message' => $request->message,
    ]);

    // ✅ RETURN JSON FOR FETCH
    return response()->json([
        'success' => true,
        'message' => 'Message sent successfully. We’ll get back to you shortly.'
    ]);
}

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return back()->with('success', 'Message deleted successfully.');
    }
}
