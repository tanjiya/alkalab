<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UnreadAnswerInThread extends Notification
{
    use Queueable;

    protected $question;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($question, $user)
    {
        $this->question = $question;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        if($this->question->question_type == 'textarea' || $this->question->answer->count() > 0)
        {
            return ['mail', 'database'];
        }

        return [];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('email.unread-answers',[
            'question' => $this->question,
            'user' => $this->user
        ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
