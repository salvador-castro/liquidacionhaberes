<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPasswordBase
{
    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperá tu contraseña - Liquidación de Haberes')
            ->markdown('emails.password-reset', [
                'url' => $this->resetUrl($notifiable),
                'user' => $notifiable,
            ]);
    }
}
