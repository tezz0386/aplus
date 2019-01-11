<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class sendVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $url='';
    public $subject='';
    public $message='';
    public $goto='';
    public $footer='';
    public function __construct($subject, $message, $url, $goto, $footer )
    {
        //
        $this->subject=$subject;
        $this->message=$message;
        $this->url=$url;
        $this->goto=$goto;
        $this->footer=$footer;
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
        return (new MailMessage)
                    ->line($this->subject)
                    ->line($this->message)
                    ->action($this->goto, url($this->url.$this->message))
                    ->line($this->footer);
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
