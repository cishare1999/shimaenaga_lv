<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordJapanese extends ResetPassword
{
  use Queueable;

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    if (static::$toMailCallback) {
      return call_user_func(static::$toMailCallback, $notifiable, $this->token);
    }

    $url_disp = config('app.domain_url');

    return (new MailMessage)
    ->from(config('app.mail_address'))
    ->subject('【買取シマエナガ】パスワードリセット')
    ->view('emails.passwordreset', [
      'reset_url' => url($url_disp.route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)),
      'url_disp' => $url_disp
    ]);
  }
}
