<?php

namespace App\Http\Controllers;

use App\Mail\ClientMail;
use App\Mail\SupportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contactPage() {
        return view('contact');
    }

    public function sendEmail(Request $request) {
        $request->validate([
            'first_name' => 'required|min:6|max:255',
            'last_name' => 'required|min:6|max:255',
            'contacting_select' => 'required',
            'email' => 'required|email',
            'contact_message' => 'required|min:15|max:255'
        ]);
        $client = $request->all();
        Mail::to($request->input('email'))->send(new ClientMail($client));
        Mail::to($request->input('email'))->send(new SupportMail($client));
        return redirect('/');
    }
}
