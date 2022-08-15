<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeUsNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subscribe;
    public $template;
    public $subject;
    public function __construct($subscribe,$template,$subject)
    {
        $this->subscribe=$subscribe;
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
        $subscribe=$this->subscribe;
        $template=$this->template;
        return $this->subject($this->subject)->view('admin.subscriber.email',compact('subscribe','template'));
    }
}
