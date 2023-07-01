<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class EmailController extends Controller
{
    public function kirim_email()
    {
        $email = 'mail.efronp@gmail.com';
        $data = array(
            'name' => "Customer",
            'body' => "This is a test email"
        );

        Mail::to($email)->send(new SendMail($data));
        return "Email telah dikirim";
    }
}
