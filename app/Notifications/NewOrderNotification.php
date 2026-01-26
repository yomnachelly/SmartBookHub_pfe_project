<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class NewOrderNotification extends Notification
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
        $url = $notifiable->role === 'admin' 
            ? route('admin.commandes.show', $this->commande->id)
            : route('employe.commandes.show', $this->commande->id);

        return [
            'message' => "Nouvelle commande #{$this->commande->id} de {$this->commande->nom_client}",
            'order_id' => $this->commande->id,
            'client_name' => $this->commande->nom_client,
            'total' => $this->commande->total,
            'url' => $url,
        ];
    }
}