<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Mail\NewContactMessage;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(StoreMessageRequest $request)
    {
        // Honeypot field already validated as "prohibited" by the FormRequest.
        // If it somehow reaches here empty, proceed normally.
        $message = Message::create($request->only(['fullname', 'email', 'message']));

        $to = config('mail.contact_to_email');

        if ($to) {
            Mail::to($to)->send(new NewContactMessage($message));
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => 'contact-sent']);
        }

        return back()->with('status', 'contact-sent');
    }
}
