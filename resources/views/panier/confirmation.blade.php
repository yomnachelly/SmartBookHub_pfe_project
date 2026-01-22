@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Message de succès -->
        <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-8 text-center">
            <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-green-800 mb-2">Commande confirmée!</h1>
            <p class="text-green-700">Votre commande a été enregistrée avec succès.</p>
            <p class="text-green-700 mt-1">Numéro de commande: <strong>#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</strong></p>
        </div>

        <!-- Détails de la commande -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4">
                <h3 class="text-lg font-bold text-[#1E1E1E]">Résumé de votre commande</h3>
            </div>
            
            <div class="p-6">
                <!-- Informations client -->
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
                            Mode de paiement: 
                            <span class="font-medium">
                                {{ $commande->mode_paiement == 'ligne' ? 'Paiement en ligne' : 'Paiement à la livraison' }}
                            </span>
                        </p>
                        <p class="text-gray-600">Statut: 
                            <span class="font-medium text-{{ $commande->statut == 'en_attente' ? 'yellow' : 'green' }}-600">
                                {{ ucfirst($commande->statut) }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <!-- Articles commandés -->
                <h4 class="font-bold text-gray-700 mb-4">Articles commandés</h4>
                <div class="space-y-3">
                    @foreach($commande->livres as $livre)
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
                                @if($livre->image)
                                <img src="{{ Storage::url($livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-full object-cover rounded">
                                @else
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium">{{ $livre->titre }}</p>
                                <p class="text-gray-500 text-sm">{{ $livre->pivot->quantite }} × {{ number_format($livre->pivot->prix, 3) }} dt</p>
                            </div>
                        </div>
                        <span class="font-bold">{{ number_format($livre->pivot->quantite * $livre->pivot->prix, 3) }} dt</span>
                    </div>
                    @endforeach
                </div>
                
                <!-- Total -->
                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total à payer:</span>
                        <span class="text-[#01B3BB]">{{ number_format($commande->total, 3) }} dt</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('welcome') }}" 
               class="bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#008D94] transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13l-2 5m2-5h12m-4 0v5"/>
                </svg>
                Continuer mes achats
            </