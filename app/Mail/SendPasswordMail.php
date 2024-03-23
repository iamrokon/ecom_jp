<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toMail,$fromMail,$email_subject,$password)
    {
        $this->toMail = $toMail;
        $this->fromMail = $fromMail;
        $this->subject = $email_subject;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $toMial = $this->toMail;
        $fromMail = $this->fromMail;
        $subject = $this->subject;
        $password = $this->password;
        $html = "";
        $html .= "Password: ".$password."<br>";
        
        $this->html($html)->to($toMial)->from($fromMail,'Netshop')->subject($subject);  
    }
}
