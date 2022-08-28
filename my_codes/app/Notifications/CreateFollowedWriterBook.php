<?php

namespace App\Notifications;

use App\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateFollowedWriterBook extends Notification
{
    use Queueable;

    public $user_name;

    public $book;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_name, Book $book)
    {
        $this->user_name = $user_name;
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('emails.create-followed-writer-book', ['user_name' => $this->user_name, 'book' => $this->book, 'book_image_address' => env('APP_URL') . '/images/books_images/' . $this->book->image]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
