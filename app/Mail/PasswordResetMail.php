<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toMail,$fromMail,$shopName,$email_subject,$html)
    {
        $this->toMail = $toMail;
        $this->fromMail = $fromMail;
        $this->shopName = $shopName;
        $this->subject = $email_subject;
        $this->html = $html;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $toMail = $this->toMail;
        $fromMail = $this->fromMail;
        $shopName = $this->shopName;
        $subject = $this->subject;
        $html = $this->html;
        
        $this->html($html)->to($toMail)->from($fromMail,$shopName)->subject($subject);  
    }
}
