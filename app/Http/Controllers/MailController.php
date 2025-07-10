<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {

       $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'data_consent' => 'required'
        ]);

        // Store the contact data
        $contact = Contact::create($request->all());

        // Mail data for user
        $userMailData = [
            'title' => 'Thanks for Reaching Out to Basic Funde Clear!',
            'body' => 'Thanks for Reaching Out to Basic Funde Clear!'
        ];

        // Mail data for admin
        $adminMailData = [
            'name' => $request->name,
            'email' => $request->email,
            'info' => $request->message,
        ];

        // Send mail to user
        Mail::to($request->email)->send(new SendMail($userMailData, 'user'));
        // Send mail to user
        $userMailSent = Mail::to($request->email)->send(new SendMail($userMailData, 'user'));

        // Send mail to admin
        $adminMailSent = Mail::to('info@basicfundeclear.com')->send(new SendMail($adminMailData, 'admin'));

        if ($userMailSent && $adminMailSent) {
          return "success";
        } else {
            return "error"; 
        }

       
    }
}
