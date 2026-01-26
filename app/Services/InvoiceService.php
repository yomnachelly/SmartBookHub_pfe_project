<?php

namespace App\Services;

use App\Models\Commande;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvoiceService
{
    /**
     * send invoice email to customer
     */
    public static function sendInvoice(Commande $commande)
    {
        try {
            Mail::to($commande->email)
                ->send(new InvoiceMail($commande));
            
            Log::info('Invoice email sent for order #' . $commande->id . ' to ' . $commande->email);
            
            return [
                'success' => true,
                'message' => 'Invoice sent successfully'
            ];
            
        } catch (\Exception $e) {
            Log::error('Failed to send invoice for order #' . $commande->id . ': ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to send invoice: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * notify admin
     */
    public static function sendInvoiceWithNotification(Commande $commande)
    {
        $result = self::sendInvoice($commande);
        
        if ($result['success']) {
            Log::info('Admin notified about invoice for order #' . $commande->id);
        }
        
        return $result;
    }
}