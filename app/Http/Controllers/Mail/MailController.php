<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\AttendanceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(){
        $details = [
            'title' => 'Testing Email',
            'body' => 'Testing Email dari akun kedua',
            'footer' => 'Sekian informasi dari saya'
        ];

        $send_email_to = 'admin@example.com';
        Mail::to($send_email_to)->send(new AttendanceMail($details));
    }
}
