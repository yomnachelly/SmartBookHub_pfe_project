<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facture Smart Book Hub</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #01B3BB; padding-bottom: 20px; }
        .invoice-title { color: #01B3BB; font-size: 28px; font-weight: bold; margin: 0; }
        .store-name { color: #666; font-size: 18px; margin: 10px 0; }
        .success-badge { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: center; font-size: 16px; }
        .info-section { margin-bottom: 25px; }
        .info-section h3 { color: #1E1E1E; border-bottom: 2px solid #eee; padding-bottom: 8px; margin-bottom: 15px; }
        .two-columns { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px; margin-bottom: 30px; }
        .column { flex: 1; min-width: 300px; }
        .table { width: 100%; border-collapse: collapse; margin: 25px 0; }
        .table th { background: #f8f9fa; text-align: left; padding: 15px; border-bottom: 2px solid #dee2e6; font-weight: bold; }
        .table td { padding: 15px; border-bottom: 1px solid #eee; }
        .table tr:hover { background: #f8f9fa; }
        .total { text-align: right; font-size: 20px; font-weight: bold; margin-top: 30px; padding-top: 20px; border-top: 2px solid #01B3BB; color: #01B3BB; }
        .footer { margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 14px; line-height: 1.8; }
        .highlight { background: #e3f2fd; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .status-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-delivered { background: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="invoice-title">FACTURE</h1>
            <p class="store-name">Smart Book Hub</p>
            <p>Date: {{ $commande->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="success-badge">
            ✅ Commande confirmée! Votre facture est prête.
        </div>

        <div class="two-columns">
            <div class="column">
                <div class="info-section">
                    <h3>Informations client</h3>
                    <p><strong>Nom:</strong> {{ $commande->nom_client }}</p>
                    <p><strong>Email:</strong> {{ $commande->email }}</p>
                    <p><strong>Téléphone:</strong> {{ $commande->telephone }}</p>
                    <p><strong>Adresse:</strong> {{ $commande->adresse }}</p>
                </div>
            </div>
            
            <div class="column">
                <div class="info-section">
                    <h3>Détails de la commande</h3>
                    <p><strong>Numéro:</strong> #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Mode de paiement:</strong> 
                        <span class="highlight">
                            {{ $commande->mode_paiement == 'ligne' ? 'Paiement en ligne' : 'Paiement à la livraison' }}
                        </span>
                    </p>
                    <p><strong>Statut:</strong> 
                        <span class="status-badge status-{{ $commande->statut }}">
                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3>Articles commandés</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Livre</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->livres as $livre)
                    <tr>
                        <td>
                            <strong>{{ $livre->titre }}</strong><br>
                            <small>ISBN: {{ $livre->isbn ?? 'N/A' }}</small>
                        </td>
                        <td>{{ $livre->pivot->quantite }}</td>
                        <td>{{ number_format($livre->pivot->prix, 3) }} dt</td>
                        <td><strong>{{ number_format($livre->pivot->quantite * $livre->pivot->prix, 3) }} dt</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total">
            <strong>TOTAL: {{ number_format($commande->total, 3) }} dt</strong>
        </div>

        <div class="footer">
            <p>Merci pour votre commande chez <strong>Smart Book Hub</strong>!</p>
            <p>Pour toute question concernant votre commande, contactez-nous à: support@smartbookhub.com</p>
            <p>Numéro de commande: #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</p>
            <p style="margin-top: 20px; font-size: 12px; color: #999;">
                Cet email a été envoyé automatiquement. Merci de ne pas y répondre.<br>
                © {{ date('Y') }} Smart Book Hub. Tous droits réservés.
            </p>
        </div>
    </div>
</body>
</html>