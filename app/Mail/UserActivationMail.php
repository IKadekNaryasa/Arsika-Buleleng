<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $activationLink;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->activationLink = route('user.activate', ['token' => $user->verification_token]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Aktivasi Akun Anda',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-activation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
