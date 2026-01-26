<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class OrderAcceptedNotification extends Notification
{
    use Queueable;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Votre commande #{$this->commande->id} a été acceptée!",
            'order_id' => $this->commande->id,
            'total' => $this->commande->total,
            'url' => route('client.commandes.show', $this->commande->id),
        ];
    }
}