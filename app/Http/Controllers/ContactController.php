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
        $h = config('site.hours');
        $now = now('Asia/Kathmandu');
        $open = $now->copy()->setTimeFromTimeString($h['open']);
        $close = $now->copy()->setTimeFromTimeString($h['close']);
        $isOpen = in_array($now->dayOfWeek, $h['days'], true) && $now->between($open, $close);

        if ($isOpen) {
            $statusText = 'Open now · closes ' . $close->format('g:i A');
        } else {
            $label = null;
            for ($i = 0; $i <= 7; $i++) {
                $day = $now->copy()->addDays($i);
                if (! in_array($day->dayOfWeek, $h['days'], true)) continue;
                if ($i === 0 && $now->gte($open)) continue;
                $label = $i === 0 ? 'today' : ($i === 1 ? 'tomorrow' : $day->format('l'));
                break;
            }
            $statusText = 'Closed now' . ($label ? ' · opens ' . $label . ' ' . $open->format('g:i A') : '');
        }

        return view('contact', ['isOpen' => $isOpen, 'statusText' => $statusText]);
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
