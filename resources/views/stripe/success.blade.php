@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Message de succès -->
        <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-8 text-center">
            <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                <div class="text-3xl">🎉</div>
            </div>
            <h1 class="text-2xl font-bold text-green-800 mb-2">Paiement réussi !</h1>
            <p class="text-green-700">Merci pour votre paiement.</p>
        </div>

        <!-- Détails du paiement -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4">
                <h3 class="text-lg font-bold text-[#1E1E1E]">Détails du paiement</h3>
            </div>
            
            <div class="p-6">
                @if(isset($commande) && $commande)
                    <!-- Informations de la commande -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2">Informations de la commande</h4>
                            <p class="text-gray-600">
                                <span class="font-medium">Numéro:</span> 
                                #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Date:</span> 
                                {{ $commande->created_at->format('d/m/Y à H:i') }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Client:</span> 
                                {{ $commande->nom_client }}
                            </p>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2">Détails du paiement</h4>
                            <p class="text-gray-600">
                                <span class="font-medium">Montant:</span> 
                                <span class="text-[#01B3BB] font-bold">{{ number_format($commande->total, 3) }} dt</span>
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Mode de paiement:</span> 
                                Paiement en ligne
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Statut:</span> 
                                <span class="font-medium text-green-600">Payé</span>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Total -->
                    <div class="mt-6 pt-4 border-t">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600">Montant total payé:</p>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-[#01B3BB]">{{ number_format($commande->total, 3) }} dt</span>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Si pas de commande spécifique -->
                    <div class="text-center py-8">
                        <p class="text-gray-600 mb-4">Votre paiement a été traité avec succès.</p>
                        <p class="text-gray-600">
                            Un email de confirmation avec votre facture vous sera envoyé.
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 mb-6">
            <h3 class="font-bold text-blue-800 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                Prochaines étapes
            </h3>
            <ul class="text-blue-700 space-y-2">
                <li class="flex items-start gap-2">
                    <span class="text-blue-500 mt-1">✓</span>
                    <span>Un email de confirmation vous a été envoyé</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-500 mt-1">✓</span>
                    <span>Votre commande est en cours de préparation</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-500 mt-1">✓</span>
                    <span>Vous serez notifié dès l'expédition</span>
                </li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" 
               class="bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#008D94] transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Retour à l'accueil
            </a>
            
            <a href="{{ url('/livres') }}" 
               class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-50 transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13l-2 5m2-5h12m-4 0v5"/>
                </svg>
                Voir les livres
            </a>
        </div>
    </div>
</div>
@endsection