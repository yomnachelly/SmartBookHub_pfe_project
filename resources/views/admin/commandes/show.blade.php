@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Commande #{{ $commande->id }}
                </h1>
                <p class="text-white/80 mt-2">
                    Détails de la commande
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                        {{ $commande->created_at->format('d/m/Y à H:i') }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route(auth()->user()->role.'.commandes.index') }}" 
                   class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour aux commandes
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Client Info & Status -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Client Info -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                Informations client
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Nom</p>
                    <p class="font-medium">{{ $commande->nom_client }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">{{ $commande->email ?? 'Non spécifié' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium">{{ $commande->telephone ?? 'Non spécifié' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Adresse</p>
                    <p class="font-medium">{{ $commande->adresse ?? 'Non spécifié' }}</p>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Statut de la commande
            </h3>
            <div class="mb-4">
                @switch($commande->statut)
                    @case('en_panier')
                        <span class="text-base font-medium px-3 py-1.5 rounded-full bg-gray-100 text-gray-800">
                            Panier
                        </span>
                        @break
                    @case('en_attente')
                        <span class="text-base font-medium px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-800">
                            En attente de validation
                        </span>
                        @break
                    @case('validee')
                        <span class="text-base font-medium px-3 py-1.5 rounded-full bg-green-100 text-green-800">
                            Commande validée
                        </span>
                        @break
                    @case('annulee')
                        <span class="text-base font-medium px-3 py-1.5 rounded-full bg-red-100 text-red-800">
                            Commande annulée
                        </span>
                        @break
                @endswitch
            </div>
            <div class="text-sm text-gray-500">
                <p>Créée le : {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                <p>Dernière mise à jour : {{ $commande->updated_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                </svg>
                Récapitulatif
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nombre d'articles :</span>
                    <span class="font-medium">{{ $commande->livres->sum('pivot.quantite') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Livres différents :</span>
                    <span class="font-medium">{{ $commande->livres->count() }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold mt-4 pt-4 border-t">
                    <span>Total commande :</span>
                    <span class="text-[#01B3BB]">
                        @php
                            $totalCalculé = 0;
                            foreach($commande->livres as $livre) {
                                $totalCalculé += $livre->pivot->quantite * $livre->pivot->prix;
                            }
                        @endphp
                        {{ number_format($totalCalculé, 3) }} dt
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="bg-gray-50 px-6 py-4">
            <h3 class="text-lg font-bold text-[#1E1E1E]">Articles commandés</h3>
        </div>
        
        <div class="p-6">
            @if($commande->livres->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Livre</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Quantité</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Prix unitaire</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCalculé = 0;
                        @endphp
                        
                        @foreach($commande->livres as $livre)
                            @php
                                $quantite = $livre->pivot->quantite;
                                $prix = $livre->pivot->prix;
                                $sousTotal = $quantite * $prix;
                                $totalCalculé += $sousTotal;
                            @endphp
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-3">
                                            @if($livre->image)
                                            <img src="{{ Storage::url($livre->image) }}" alt="{{ $livre->titre }}" class="w-10 h-10 object-cover rounded-lg">
                                            @else
                                            <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                            </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-medium block">{{ $livre->titre }}</span>
                                            <span class="text-sm text-gray-500">{{ $livre->auteur }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-medium">{{ $quantite }}</td>
                                <td class="py-4 px-4">{{ number_format($prix, 3) }} dt</td>
                                <td class="py-4 px-4 font-semibold">{{ number_format($sousTotal, 3) }} dt</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td colspan="3" class="py-4 px-4 text-right font-bold">
                                Total commande :
                            </td>
                            <td class="py-4 px-4 font-bold text-lg text-[#01B3BB]">
                                {{ number_format($totalCalculé, 3) }} dt
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-lg">Aucun article dans cette commande</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    @if($commande->statut == 'en_attente')
    <div class="flex justify-end gap-4 mt-6">
        <form method="POST" action="{{ route(auth()->user()->role.'.commandes.annuler', $commande->id) }}" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande? Cette action est irréversible.')">
            @csrf
            <button type="submit" 
                    class="px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Annuler la commande
            </button>
        </form>

        <form method="POST" action="{{ route(auth()->user()->role.'.commandes.valider', $commande->id) }}" 
              onsubmit="return confirm('Valider cette commande? Le client sera notifié et le stock sera déduit.')">
            @csrf
            <button type="submit" 
                    class="px-6 py-3 bg-green-500 text-white rounded-xl font-medium hover:bg-green-600 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Valider la commande
            </button>
        </form>
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .transition {
        transition: all 0.3s ease;
    }
</style>
@endsection