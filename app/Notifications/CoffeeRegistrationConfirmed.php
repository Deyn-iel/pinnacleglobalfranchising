<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CoffeeRegistrationConfirmed extends Notification
{
    use Queueable;

    public $reg;

    /**
     * Create a new notification instance.
     */
    public function __construct($reg)
    {
        $this->reg = $reg;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
{
  return (new MailMessage)
    ->subject('Registration Confirmed')
    ->greeting('Hi ' . $this->reg->first_name . '!')
    ->line('Your registration has been completed by HR.')
    ->line('Event: ' . $this->reg->event_name)
    ->line('Session: ' . $this->reg->session_title)
    ->line('Schedule: ' . $this->reg->session_datetime)
    ->line('Travel Order and Registration Ticket have been issued.')
    ->line('Thank you!');
}


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
