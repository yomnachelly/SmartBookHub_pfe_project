<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PasswordChangedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $changedAt;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->changedAt = now();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de changement de mot de passe',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.password-changed',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}