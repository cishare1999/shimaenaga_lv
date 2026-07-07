<?php

namespace App\Notifications;

use Illuminate\Auth\Events\Verified;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class VerifyEmailJapanese extends VerifyEmail
{

  use Queueable;

  public function via($notifiable)
	{
		return ['mail'];
	}

  public function toMail($notifiable)
  {
    $verificationUrl = $this->verificationUrl($notifiable);

    if (static::$toMailCallback) {
        return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
    }

    $com_line_d = config('app.com_line');
    $url_disp = config('app.domain_url');

    //キャリアメールの判別して平分メールを送る
    if(strpos($notifiable->email,'ne.jp') !== false){
      return (new BareMail)
        ->from(config('app.mail_address'))
        ->to($notifiable->email)
        ->bcc(config('app.mail_address'))
        ->subject('【買取シマエナガ】メールアドレス確認')
        ->text('emails.verifyemail2', [
            'verify_url' => $verificationUrl,
            'com_line' => $com_line_d,
        ]);
    }else{
      return (new MailMessage)
      ->from(config('app.mail_address'))
      ->bcc(config('app.mail_address'))
      ->subject('【買取シマエナガ】メールアドレス確認')
      ->view('emails.verifyemail', [
          'verify_url' => $verificationUrl,
          'com_line' => $com_line_d,
          'url_disp' => $url_disp,
      ]);
    }


  }

}
class BareMail extends Mailable {
	use Queueable, SerializesModels;
	public function build() {}
}

