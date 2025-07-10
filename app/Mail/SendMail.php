<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $recipient)
    {
        $this->mailData = $mailData;
        $this->recipient = $recipient;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->recipient === 'user') {
            // dd('hi');
            return $this->subject('Thanks for Reaching Out to Basic Funde Clear!')
                ->view('emails.usermail');
        } elseif ($this->recipient === 'admin') {
          
            return $this->subject('New Contact Form Submission')
                ->view('emails.adminmail');
        }
    }
}