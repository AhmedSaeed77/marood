<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('site.reset_password_subject'))
              ->greeting(__('site.verify_email_greeting'))
            ->line(__('site.reset_password_line1'))
            ->action(__('site.reset_password_action'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(__('site.reset_password_line2'));
    }
}
