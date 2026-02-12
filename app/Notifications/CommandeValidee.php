<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommandeValidee extends Notification
{
    use Queueable;

    protected $commande;

    /**
     * Create a new notification instance.
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Commande validée - ' . $this->commande->reference)
            ->greeting('Bonjour ' . $this->commande->nom_client . ',')
            ->line('Votre commande #' . $this->commande->id . ' a été validée avec succès!')
            ->line('Référence: ' . $this->commande->reference)
            ->line('Montant total: ' . number_format($this->commande->total, 3, '.', ' ') . ' dt')
            ->action('Voir ma commande', route('client.commandes.show', $this->commande->id))
            ->line('Merci pour votre confiance!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'commande_id' => $this->commande->id,
            'reference' => $this->commande->reference,
            'total' => $this->commande->total,
            'statut' => $this->commande->statut,
            'message' => 'Votre commande #' . $this->commande->id . ' a été validée.',
            'url'         => route('client.commandes.show', $this->commande->id),
        ];
    }
}