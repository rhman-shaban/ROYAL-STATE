<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\EmailTemplate;
class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $template;
    public $subject;
    public function __construct($template,$subject)
    {
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
        return $this->subject($this->subject)->view('user.profile.order-email',compact('template'));
    }
}
