<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your OTP Code')
                    ->view('emails.otp')
                    ->with([
                        'otp' => $this->user->otp_code, // assuming $user->otp holds the code
                        'user' => $this->user,// assuming $user has a name attribute
                    ]);
    }
}
