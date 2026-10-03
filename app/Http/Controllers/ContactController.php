<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(StoreContactMessageRequest $request)
    {
        if ($request->filled('website')) {
            return redirect()->back()->with('success', 'Thank you for contacting us. We will get back to you soon.');
        }

        $validated = $request->validated();

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
        ]);

        // TODO: Send email notification to first email in config('site.emails')

        return redirect()->back()->with('success', 'Thank you for contacting us. We will get back to you soon.');
    }
}
