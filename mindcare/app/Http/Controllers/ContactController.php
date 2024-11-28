<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store the contact message in the database
        Contact::create($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
    public function updateStatus(Request $request, Contact $contact)
{
    // Validate the status (either resolved or unresolved)
    $validated = $request->validate([
        'status' => 'required|in:resolved,irresolved',
    ]);

    // Update the contact's status
    if ($validated['status'] == 'resolved') {
        $contact->resolved = true;
        $contact->irresolved = false;
    } else {
        $contact->resolved = false;
        $contact->irresolved = true;
    }

    // Save the updated contact
    $contact->save();

    // Redirect back with a success message
    return redirect()->route('admin.contacts.index')->with('success', 'Status updated successfully!');
}


    // Optional: Admin view to list all contact messages
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }
    
}
