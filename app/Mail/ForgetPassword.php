<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $subject;
    public $user;
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
        return $this->subject($this->subject)->view('email-template.send-forget-token',compact('template','user'));
    }
}
