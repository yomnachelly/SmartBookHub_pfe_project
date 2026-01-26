@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold text-white">
                    Commande #{{ $commande->id }}
                </h1>
                <p class="text-white/80 mt-2 max-w-2xl">
                    Détails de votre commande du {{ $commande->created_at->format('d/m/Y à H:i') }}
                </p>
                <div class="flex flex-wrap items-center mt-4 gap-3">
                    @php
                        $statusText = [
                            'en_attente' => 'En attente',
                            'validee' => 'Validée',
                            'annulee' => 'Annulée',
                            'en_panier' => 'En panier',
                        ];
                    @endphp
                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-sm font-medium">
                        {{ $statusText[$commande->statut] ?? $commande->statut }}
                    </span>
                    <span class="text-white/90 text-sm">
                        Total: <span class="font-bold">{{ number_format($commande->total, 3, '.', ' ') }} dt</span>
                    </span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('client.commandes.index') }}" 
                   class="flex items-center gap-2 bg-white text-[#01B3BB] px-5 py-3 rounded-xl font-medium hover:bg-white/90 transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Retour aux commandes
                </a>
                @if($commande->statut == 'validee')
                <a href="{{ route('commandes.facture', $commande) }}" 
                   class="flex items-center gap-2 bg-[#FFC62A] text-[#1E1E1E] px-5 py-3 rounded-xl font-medium hover:bg-[#FFD666] transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    Télécharger la facture
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-xl font-bold text-gray-800">Articles commandés</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $commande->livres->count() }} article(s) dans cette commande</p>
                </div>
                <div class="p-6">
                    @if($commande->livres->count() > 0)
                    <div class="space-y-4">
                        @foreach($commande->livres as $livre)
                        <div class="flex items-start border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                            @if($livre->image)
                            <img src="{{ asset('storage/' . $livre->image) }}" 
                                 alt="{{ $livre->titre }}" 
                                 class="w-16 h-20 object-cover rounded-lg mr-4">
                            @else
                            <div class="w-16 h-20 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $livre->titre ?? 'Livre non disponible' }}</h3>
                                <p class="text-sm text-gray-600 mt-1">Auteur: {{ $livre->auteur ?? 'Non spécifié' }}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-sm text-gray-500">Quantité: {{ $livre->pivot->quantite }}</span>
                                    <span class="font-medium text-gray-900">{{ number_format($livre->pivot->prix * $livre->pivot->quantite, 3, '.', ' ') }} dt</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Récapitulatif</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-medium">{{ number_format($commande->total, 3, '.', ' ') }} dt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Livraison</span>
                                <span class="font-medium">0.000 dt</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-200">
                                <span class="text-lg font-bold text-gray-800">Total</span>
                                <span class="text-lg font-bold text-[#01B3BB]">{{ number_format($commande->total, 3, '.', ' ') }} dt</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p>Aucun article dans cette commande</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Statut de la commande</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">État actuel</span>
                            @php
                                $statusColors = [
                                    'en_attente' => 'text-yellow-600 bg-yellow-100',
                                    'validee' => 'text-green-600 bg-green-100',
                                    'annulee' => 'text-red-600 bg-red-100',
                                    'en_panier' => 'text-blue-600 bg-blue-100',
                                ];
                                $statusText = [
                                    'en_attente' => 'En attente',
                                    'validee' => 'Validée',
                                    'annulee' => 'Annulée',
                                    'en_panier' => 'En panier',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$commande->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusText[$commande->statut] ?? $commande->statut }}
                            </span>
                        </div>
                        @if($commande->statut == 'en_attente')
                        <p class="text-sm text-gray-600">Votre commande est en attente de traitement par notre équipe.</p>
                        @elseif($commande->statut == 'validee')
                        <p class="text-sm text-green-600">✓ Votre commande a été validée et traitée.</p>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Date de commande</label>
                        <p class="text-gray-900">{{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Dernière mise à jour</label>
                        <p class="text-gray-900">{{ $commande->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Informations de livraison</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Nom du client</label>
                        <p class="text-gray-900">{{ $commande->nom_client }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Adresse email</label>
                        <p class="text-gray-900">{{ $commande->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Téléphone</label>
                        <p class="text-gray-900">{{ $commande->telephone }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Adresse de livraison</label>
                        <p class="text-gray-900 whitespace-pre-line">{{ $commande->adresse }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .transition {
        transition: all 0.3s ease;
    }
    
    .whitespace-pre-line {
        white-space: pre-line;
    }
</style>
@endsection