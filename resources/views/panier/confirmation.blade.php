@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        
        <div class="
            {{ $commande->mode_paiement === 'ligne' && $commande->statut === 'en_attente'
                ? 'bg-yellow-50 border-yellow-200'
                : 'bg-green-50 border-green-200' }}
            border rounded-xl p-6 mb-8 text-center">

            <div class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4
                {{ $commande->mode_paiement === 'ligne' && $commande->statut === 'en_attente'
                    ? 'bg-yellow-100'
                    : 'bg-green-100' }}">

                @if($commande->mode_paiement === 'ligne' && $commande->statut === 'en_attente')
                    <div class="text-3xl">⏳</div>
                @else
                    <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @endif
            </div>

            @if($commande->mode_paiement === 'ligne' && $commande->statut === 'en_attente')
                <h1 class="text-2xl font-bold text-yellow-800 mb-2">
                    Confirmation de votre commande
                </h1>
                <p class="text-yellow-700">
                    Veuillez vérifier les informations ci-dessous et confirmer le paiement.
                </p>
            @else
                <h1 class="text-2xl font-bold text-green-800 mb-2">
                    Commande confirmée !
                </h1>
                <p class="text-green-700">
                    Votre commande a été enregistrée avec succès.
                </p>
            @endif

            <p class="mt-2 font-medium {{ $commande->mode_paiement === 'ligne' && $commande->statut === 'en_attente' ? 'text-yellow-700' : 'text-green-700' }}">
                Référence :
                <strong>{{ $commande->reference ?? 'CMD-' . str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</strong>
            </p>

            @if($commande->mode_paiement === 'ligne' && $commande->statut === 'validee')
                <div class="mt-4">
                    <a href="{{ route('commande.facture', $commande->id) }}"
                       class="inline-flex items-center gap-2 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Télécharger la facture
                    </a>
                </div>
            @endif

            @if($commande->mode_paiement === 'sur_place')
                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-blue-700 text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <strong>Paiement à la livraison :</strong> Vous paierez directement au livreur lors de la réception de votre commande.
                        La facture papier vous sera remise à ce moment-là.
                    </p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4">
                <h3 class="text-lg font-bold text-[#1E1E1E]">Résumé de votre commande</h3>
            </div>

            <div class="p-6">
                {{-- Infos client et paiement --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="font-bold text-gray-700 mb-2">Informations client</h4>
                        <p class="text-gray-600">{{ $commande->nom_client }}</p>
                        <p class="text-gray-600">{{ $commande->email }}</p>
                        <p class="text-gray-600">{{ $commande->telephone }}</p>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-700 mb-2">Livraison & Paiement</h4>
                        <p class="text-gray-600">{{ $commande->adresse }}</p>
                        <p class="text-gray-600">
                            Mode de paiement :
                            <span class="font-medium">
                                {{ $commande->mode_paiement === 'ligne'
                                    ? 'Paiement en ligne'
                                    : 'Paiement à la livraison' }}
                            </span>
                        </p>
                        <p class="text-gray-600">
                            Statut :
                            <span class="font-medium
                                {{ $commande->statut === 'en_attente'
                                    ? 'text-yellow-600'
                                    : ($commande->statut === 'validee' ? 'text-green-600' : 'text-gray-600') }}">
                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                            </span>
                        </p>
                    </div>
                </div>

                {{-- Articles commandés --}}
                <h4 class="font-bold text-gray-700 mb-4">Articles commandés</h4>
                <div class="space-y-3">
                    @if(isset($commande->livres) && count($commande->livres) > 0)
                        @foreach($commande->livres as $livre)
                        <div class="flex justify-between items-center border-b pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
                                    @if(isset($livre->image) && $livre->image)
                                    <img src="{{ Storage::url($livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-full object-cover rounded">
                                    @else
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium">{{ $livre->titre }}</p>
                                    <p class="text-gray-500 text-sm">
                                        {{ $livre->pivot->quantite ?? $livre->quantite }} × 
                                        {{ number_format($livre->pivot->prix ?? $livre->prix, 3) }} dt
                                    </p>
                                </div>
                            </div>
                            <span class="font-bold">
                                {{ number_format(($livre->pivot->quantite ?? $livre->quantite) * ($livre->pivot->prix ?? $livre->prix), 3) }} dt
                            </span>
                        </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">Aucun livre dans cette commande</p>
                    @endif
                </div>

                {{-- Total --}}
                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total à payer :</span>
                        <span class="text-[#01B3BB]">{{ number_format($commande->total, 3) }} dt</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <a href="{{ route('welcome') }}"
               class="bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#008D94] transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13l-2 5m2-5h12m-4 0v5"/>
                </svg>
                Continuer mes achats
            </a>

            {{-- btn paiement si paiement en ligne + en attente --}}
            @if($commande->mode_paiement === 'ligne' && $commande->statut === 'en_attente')
                <form method="POST" action="{{ route('stripe.checkout', $commande->id) }}">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-green-600 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Confirmer et payer
                    </button>
                </form>
            @endif
        </div>

        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-center">
            <p class="text-yellow-700 text-sm">
                <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <strong>Important:</strong> Conservez votre référence de commande ({{ $commande->reference ?? 'CMD-' . str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}) 
                pour tout suivi ultérieur.
                @if($commande->mode_paiement === 'ligne')
                    @if($commande->statut === 'validee')
                        Vous pouvez télécharger votre facture ci-dessus.
                    @elseif($commande->statut === 'en_attente')
                        Veuillez confirmer le paiement pour finaliser votre commande.
                    @endif
                @else
                    <strong>La facture papier vous sera remise lors de la livraison.</strong>
                @endif
            </p>
        </div>

        @guest
        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-center">
            <p class="text-blue-700 text-sm">
                💡 <strong>Conseil:</strong> 
                <a href="{{ route('register') }}" class="underline hover:text-blue-900">Créez un compte</a> 
                pour suivre facilement vos commandes et accéder à votre historique.
            </p>
        </div>
        @endguest
    </div>
</div>
@endsection

@section('styles')
<style>
    .transition {
        transition: all 0.3s ease;
    }
</style>
@endsection