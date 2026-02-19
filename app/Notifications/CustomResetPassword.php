<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        // Generate the same reset link Laravel expects
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
    ->subject('Set Up Your Account Password')
    ->greeting('Hello!')
    ->line('Your account has been successfully created.')
    ->line('To complete your registration, please create your password by clicking the button below.')
    ->action('Create Password', $url)
    ->line('This link will expire in 60 minutes for security purposes.')
    ->line('If you did not expect this email, please ignore it.')
    ->salutation('Regards, Pinnacle Support');

    }
}
