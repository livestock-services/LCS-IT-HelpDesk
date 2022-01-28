<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function mail()
    {
        $data = array('name'=>"Our Code World");
        // Path or name to the blade template to be rendered
        $template_path = 'email_template';

        Mail::send(['text'=> $template_path ], $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('anyemail@emails.com', 'Receiver Name')->subject('Laravel First Mail');
            // Set the sender
            $message->from('mymail@mymailaccount.com','Our Code World');
        });

        return "Basic email sent, check your inbox.";
    }
}
