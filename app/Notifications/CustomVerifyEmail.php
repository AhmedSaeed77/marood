<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);


        return (new MailMessage)
            ->subject(__('site.verify_email_subject'))
            ->greeting(__('site.verify_email_greeting'))
            ->line(__('site.verify_email_line_1'))
            ->action(__('site.verify_email_button'), $verificationUrl)
            ->line(__('site.verify_email_line_2'));
    }
}
