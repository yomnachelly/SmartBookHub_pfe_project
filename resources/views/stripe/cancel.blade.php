@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 mb-8 text-center">
            <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                <div class="text-3xl">❌</div>
            </div>
            <h1 class="text-2xl font-bold text-red-800 mb-2">Paiement annulé</h1>
            <p class="text-red-700">Vous pouvez réessayer.</p>
            
            @if(isset($errorMessage))
            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-yellow-700 text-sm">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $errorMessage }}
                </p>
            </div>
            @endif
        </div>

        @if(isset($commande) && $commande)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4">
                <h3 class="text-lg font-bold text-[#1E1E1E]">Récapitulatif de la commande</h3>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="font-bold text-gray-700 mb-2">Informations de la commande</h4>
                        <p class="text-gray-600">
                            <span class="font-medium">Numéro:</span> 
                            #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Référence:</span> 
                            {{ $commande->reference ?? 'CMD-' . str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
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
                            <span class="font-medium text-red-600">Non payé</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-amber-50 border border-amber-100 rounded-xl p-6 mb-6">
            <h3 class="font-bold text-amber-800 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                Options disponibles
            </h3>
            <ul class="text-amber-700 space-y-2">
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-1">•</span>
                    <span>Vous pouvez réessayer le paiement quand vous le souhaitez</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-1">•</span>
                    <span>Aucun montant n'a été débité de votre compte</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-amber-500 mt-1">•</span>
                    <span>Si le problème persiste, contactez notre service client</span>
                </li>
            </ul>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(isset($commande) && $commande)
            <a href="{{ route('paiement.retry', $commande->id) }}" 
               class="bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#008D94] transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Réessayer le paiement
            </a>
            @endif
            
            <a href="/" 
               class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-50 transition flex items-center justify-center gap-2">
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
        
        <div class="mt-6 text-center">
            <p class="text-gray-500 text-sm">
                Besoin d'aide ? 
                <a href="{{ route('contact') }}" class="text-[#01B3BB] hover:underline">Contactez-nous</a>
            </p>
        </div>
    </div>
</div>
@endsection