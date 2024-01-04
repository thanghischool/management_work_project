<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class ForgotPasswordMailable extends Mailable
{
    public $email;
    public $expiresAt;
    public $url;

    public function __construct($email, $expiresAt, $url)
    {
        $this->email = $email;
        $this->expiresAt = $expiresAt;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('emails.forgot-password')
            ->subject('Đặt lại mật khẩu Dira')
            ->with([
                'email' => $this->email,
                'expiresAt' => $this->expiresAt,
                'url' => $this->url,
            ]);
    }
}
