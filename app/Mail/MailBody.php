<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailBody extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $bodymessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $bodymessage)
    {
        $this->title = $title;
        $this->bodymessage = $bodymessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('njn046@gmail.com')->view('web.mailbody', ['title'=>$this->title,'bodymessage'=>$this->bodymessage]);
    }
}
