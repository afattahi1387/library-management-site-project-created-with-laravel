<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNews extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public $news;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $news)
    {
        $this->email = $email;
        $this->news = $news;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send-news')->to($this->email, 'خبر جدید از خبرنامه');
    }
}
