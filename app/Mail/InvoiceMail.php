<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function build()
    {
        $pdf = Pdf::loadView('invoices.invoice', ['commande' => $this->commande]);
        
        return $this->subject('Facture pour votre commande #' . $this->commande->reference)
                    ->view('emails.invoice')
                    ->attachData($pdf->output(), 'facture-' . $this->commande->reference . '.pdf');
    }
}