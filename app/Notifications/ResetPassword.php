<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends ResetPasswordNotification
{
  public function toMail($notifiable)
  {
    $url = config('app.frontend_url') . '/reset-password/' . $this->token;

    return (new MailMessage)
      ->line('You are receiving this email because we received a password reset request for your account.')
      ->action('Reset Password', $url)
      ->line('If you did not request a password reset, no further action is required.');
  }
}
