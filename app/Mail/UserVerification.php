<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class UserVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $template;
    public $subject;
    public function __construct($user,$template,$subject)
    {
        $this->user=$user;
        $this->template=$template;
        $this->subject=$subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template=$this->template;
        $user=$this->user;
        return $this->subject($this->subject)->view('email-template.email-verification',compact('user','template'));
    }
}
