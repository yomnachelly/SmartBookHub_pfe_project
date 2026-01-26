<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $commande->id }} - SmartBookHub</title>
    <style>
        /* Print and PDF optimized for A4 */
        @page {
            size: A4 portrait;
            margin: 15mm 15mm 15mm 15mm;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 0;
            width: 180mm; /* 210mm - 15mm margins on each side */
        }
        
        /* Container to ensure everything fits */
        .invoice-container {
            width: 100%;
            max-width: 180mm;
            margin: 0 auto;
        }
        
        /* Header */
        .header {
            border-bottom: 2px solid #01B3BB;
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }
        
        .company-info {
            flex: 1;
            max-width: 120mm;
        }
        
        .company-name {
            font-size: 18pt;
            font-weight: bold;
            color: #01B3BB;
            margin-bottom: 3px;
        }
        
        .company-details {
            font-size: 8pt;
            color: #666;
            line-height: 1.2;
        }
        
        .invoice-meta {
            text-align: right;
            min-width: 55mm;
        }
        
        .invoice-label {
            font-size: 12pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 3px;
        }
        
        .invoice-number {
            font-size: 14pt;
            font-weight: bold;
            color: #01B3BB;
        }
        
        .invoice-date {
            font-size: 9pt;
            color: #666;
        }
        
        /* Client Information */
        .client-section {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8fafc;
            border-radius: 3px;
            border: 1px solid #e8f4f5;
            font-size: 9pt;
            width: 100%;
            box-sizing: border-box;
        }
        
        .client-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 2px;
            font-size: 8pt;
        }
        
        .client-value {
            color: #000;
            word-break: break-word;
        }
        
        .status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-validee {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-en_attente {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-annulee {
            background: #fee2e2;
            color: #991b1b;
        }
        
        /* Items Table */
        .items-section {
            margin-bottom: 15px;
            width: 100%;
        }
        
        .section-title {
            font-size: 11pt;
            font-weight: bold;
            color: #01B3BB;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #e8f4f5;
            width: 100%;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            table-layout: fixed; /* Fixed layout for consistent width */
        }
        
        .items-table th {
            background: #01B3BB;
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #01B3BB;
        }
        
        .items-table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            vertical-align: top;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Fixed column widths */
        .col-book {
            width: 95mm; /* 40% of 180mm */
        }
        
        .col-author {
            width: 45mm; /* 25% of 180mm */
        }
        
        .col-quantity {
            width: 18mm; /* 10% of 180mm */
        }
        
        .col-price {
            width: 22mm; /* 12% of 180mm */
        }
        
        .col-total {
            width: 24mm; /* 13% of 180mm */
        }
        
        .book-info {
            display: flex;
            flex-direction: column;
        }
        
        .book-title {
            font-weight: bold;
            color: #000;
            margin-bottom: 2px;
            word-wrap: break-word;
        }
        
        .book-author {
            font-size: 8pt;
            color: #666;
        }
        
        .quantity {
            text-align: center;
        }
        
        .quantity-badge {
            display: inline-block;
            width: 22px;
            height: 22px;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 3px;
            text-align: center;
            line-height: 22px;
            font-weight: bold;
            font-size: 8pt;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-left {
            text-align: left;
        }
        
        /* Summary Section */
        .summary-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
            width: 100%;
        }
        
        .summary-table {
            width: 85mm; /* ~47% of total width */
            border-collapse: collapse;
            font-size: 9pt;
        }
        
        .summary-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #e8f4f5;
        }
        
        .summary-table .total-row td {
            border-top: 2px solid #e8f4f5;
            font-weight: bold;
            padding-top: 8px;
        }
        
        .summary-label {
            color: #666;
        }
        
        .summary-value {
            text-align: right;
            color: #000;
        }
        
        .summary-total {
            color: #01B3BB;
            font-size: 10pt;
        }
        
        /* Footer */
        .footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e8f4f5;
            font-size: 8pt;
            color: #666;
            width: 100%;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 10px;
            width: 100%;
        }
        
        .footer-column {
            padding-right: 10px;
        }
        
        .footer-title {
            font-weight: bold;
            color: #01B3BB;
            margin-bottom: 4px;
            font-size: 9pt;
        }
        
        .thank-you {
            text-align: center;
            font-weight: bold;
            color: #01B3BB;
            margin: 10px 0 5px 0;
            font-size: 9pt;
            width: 100%;
        }
        
        .generated-info {
            text-align: center;
            font-size: 7pt;
            color: #999;
            width: 100%;
        }
        
        /* Print optimizations */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                width: 180mm;
                margin: 0;
                padding: 0;
            }
            
            .invoice-container {
                width: 180mm;
                max-width: 180mm;
            }
            
            .items-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .page-break {
                page-break-before: always;
            }
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
            width: 100%;
        }
        
        /* Utility */
        .bold {
            font-weight: bold;
        }
        
        .no-wrap {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="company-name">SmartBookHub</div>
                <div class="company-details">
                    123 Avenue des Livres, Tunis 1002, Tunisie<br>
                    Tél: +216 71 123 456 | Email: contact@smartbookhub.com<br>
                    RCS Tunis B 123 456 789 | TVA: FR12345678901
                </div>
            </div>
            
            <div class="invoice-meta">
                <div class="invoice-label">FACTURE</div>
                <div class="invoice-number">#ORD-{{ str_pad($commande->id, 3, '0', STR_PAD_LEFT) }}</div>
                <div class="invoice-date">{{ $commande->created_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>
        
        <!-- Client Information -->
        <div class="client-section">
            <div>
                <div class="client-label">Client</div>
                <div class="client-value">{{ $commande->nom_client }}</div>
            </div>
            <div>
                <div class="client-label">Email</div>
                <div class="client-value">{{ $commande->email }}</div>
            </div>
            <div>
                <div class="client-label">Téléphone</div>
                <div class="client-value">{{ $commande->telephone }}</div>
            </div>
            <div>
                <div class="client-label">Adresse</div>
                <div class="client-value" style="white-space: pre-line;">{{ $commande->adresse }}</div>
            </div>
            <div>
                <div class="client-label">Date commande</div>
                <div class="client-value">{{ $commande->created_at->format('d/m/Y') }}</div>
            </div>
            <div>
                <div class="client-label">Statut</div>
                <div class="client-value">
                    @php
                        $statusText = [
                            'en_attente' => 'En attente',
                            'validee' => 'Validée',
                            'annulee' => 'Annulée',
                            'en_panier' => 'En panier',
                        ];
                        $statusClass = 'status-' . $commande->statut;
                    @endphp
                    <span class="status {{ $statusClass }}">
                        {{ $statusText[$commande->statut] ?? $commande->statut }}
                    </span>
                </div>
            </div>
            @if($commande->mode_paiement)
            <div>
                <div class="client-label">Paiement</div>
                <div class="client-value">{{ $commande->mode_paiement }}</div>
            </div>
            @endif
        </div>
        
        <!-- Items -->
        <div class="items-section">
            <div class="section-title">Articles commandés</div>
            
            @if(count($commande->livres) > 0)
            <table class="items-table">
                <thead>
                    <tr>
                        <th class="col-book text-left">Livre</th>
                        <th class="col-author text-left">Auteur</th>
                        <th class="col-quantity text-center">Qté</th>
                        <th class="col-price text-right">Prix unitaire</th>
                        <th class="col-total text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($commande->livres as $livre)
                    @php
                        $quantite = $livre->pivot->quantite ?? 0;
                        $prix = $livre->pivot->prix ?? 0;
                        $sousTotal = $quantite * $prix;
                        $total += $sousTotal;
                    @endphp
                    <tr>
                        <td class="col-book">
                            <div class="book-info">
                                <div class="book-title">{{ $livre->titre ?? 'Livre non disponible' }}</div>
                                @if($livre->isbn ?? false)
                                <div class="book-author">ISBN: {{ $livre->isbn }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="col-author">{{ $livre->auteur ?? 'Non spécifié' }}</td>
                        <td class="col-quantity text-center">
                            <span class="quantity-badge">{{ $quantite }}</span>
                        </td>
                        <td class="col-price text-right no-wrap">{{ number_format($prix, 3, '.', ' ') }} dt</td>
                        <td class="col-total text-right no-wrap">{{ number_format($sousTotal, 3, '.', ' ') }} dt</td>
                    </tr>
                    @endforeach
                    
                    <!-- Summary rows -->
                    <tr>
                        <td colspan="3" class="text-right bold">Sous-total</td>
                        <td colspan="2" class="text-right bold no-wrap">{{ number_format($total, 3, '.', ' ') }} dt</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right bold">Livraison</td>
                        <td colspan="2" class="text-right bold no-wrap">0.000 dt</td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="3" class="text-right bold">Total TTC</td>
                        <td colspan="2" class="text-right bold no-wrap" style="color: #01B3BB; font-size: 10pt;">
                            {{ number_format($total, 3, '.', ' ') }} dt
                        </td>
                    </tr>
                </tbody>
            </table>
            @else
            <div class="empty-state">
                Aucun article dans cette commande
            </div>
            @endif
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-title">Conditions de paiement</div>
                    Paiement à réception<br>
                    Délai: 30 jours<br>
                    Pénailité: 1.5%/mois
                </div>
                
                <div class="footer-column">
                    <div class="footer-title">Informations légales</div>
                    SmartBookHub SARL<br>
                    Capital: 50,000 DT<br>
                    SIRET: 12345678900012
                </div>
                
                <div class="footer-column">
                    <div class="footer-title">Contact</div>
                    support@smartbookhub.com<br>
                    +216 71 123 456<br>
                    www.smartbookhub.com
                </div>
            </div>
            
            <div class="thank-you">
                Merci pour votre achat chez SmartBookHub !
            </div>
            
            <div class="generated-info">
                Facture générée automatiquement le {{ now()->format('d/m/Y à H:i') }} • Référence: INV-{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>
    </div>
</body>
</html>