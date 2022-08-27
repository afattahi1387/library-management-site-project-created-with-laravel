<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnswerToMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public $message;

    public $answer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $message, $answer)
    {
        $this->email = $email;
        $this->message = $message;
        $this->answer = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.answer-to-message')->to($this->email, $this->message->name);
    }
}
