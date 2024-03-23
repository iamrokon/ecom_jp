<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender_name,$phone,$toMail,$fromMail,$email_subject,$email_content)
    {
        $this->name = $sender_name;
        $this->toMail = $toMail;
        $this->fromMail = $fromMail;
        $this->phone = $phone;
        $this->subject = $email_subject;
        $this->content = $email_content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $toMial = $this->toMail;
        $fromMail = $this->fromMail;
        $subject = $this->subject;
        $phone = $this->phone;
        $html = $this->content;
        //$html = "";
        //$html .= "Name: ".$name."<br>";
        //if($phone != ""){
        //$html .= "Phone: ".$phone."<br>";
        //}
        //$html .= "Message: ".$content."<br>";
        
        $this->html($html)->to($toMial)->from($fromMail,$name)->subject($subject);  
    }
}
