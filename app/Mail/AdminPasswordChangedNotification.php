<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AdminPasswordChangedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plainPassword;
    public $changedAt;


    public function __construct(User $user, string $plainPassword)
    {
        $this->user          = $user;
        $this->plainPassword = $plainPassword;
        $this->changedAt     = now();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre mot de passe a été réinitialisé par un administrateur',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-password-changed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}