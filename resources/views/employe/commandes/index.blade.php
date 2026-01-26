@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Gestion des Commandes
                </h1>
                <p class="text-white/80 mt-2">
                    Gérez toutes les commandes de votre boutique
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">{{ $commandes->count() }} commandes</span>
                    <span class="text-white/60 text-sm">•</span>
                    <span class="text-white/80 text-sm">{{ $commandes->where('statut', 'en_attente')->count() }} en attente</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex gap-3">
                    <a href="{{ route('employe.dashboard') }}" 
                       class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total commandes</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $commandes->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">En attente</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $commandes->where('statut', 'en_attente')->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Validées</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $commandes->where('statut', 'validee')->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Valeur totale</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ number_format($commandes->sum('total'), 3) }} dt
                    </h3>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
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

    <!-- Commandes Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-8">
        <div class="bg-[#01B3BB] text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold">Liste des Commandes</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm">{{ $commandes->count() }} commandes</span>
            </div>
        </div>
        
        <div class="p-6">
            @if($commandes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">ID</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Client</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Total</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Statut</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Date</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4 font-medium">#{{ $commande->id }}</td>
                            <td class="py-4 px-4">
                                <div>
                                    <span class="font-medium block">{{ $commande->nom_client }}</span>
                                    <span class="text-sm text-gray-500">{{ $commande->email }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4 font-semibold">{{ number_format($commande->total, 3) }} dt</td>
                            <td class="py-4 px-4">
                                @switch($commande->statut)
                                    @case('en_panier')
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-800">
                                            Panier
                                        </span>
                                        @break
                                    @case('en_attente')
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                        @break
                                    @case('validee')
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800">
                                            Validée
                                        </span>
                                        @break
                                    @case('annulee')
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-red-100 text-red-800">
                                            Annulée
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-500">
                                {{ $commande->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('employe.commandes.show', $commande->id) }}" 
                                       class="px-3 py-1 bg-[#01B3BB] text-white rounded-lg text-sm font-medium hover:bg-[#008D94] transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Voir
                                    </a>
                                    
                                    <!-- Download Invoice Button - Only for validated orders -->
                                    @if($commande->statut == 'validee')
                                    <a href="{{ route('employe.commandes.downloadFacture', $commande->id) }}" 
                                       class="px-3 py-1 bg-purple-500 text-white rounded-lg text-sm font-medium hover:bg-purple-600 transition flex items-center gap-1"
                                       title="Télécharger la facture">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Facture
                                    </a>
                                    @endif

                                    @if($commande->statut == 'en_attente')
                                    <form method="POST" action="{{ route('employe.commandes.valider', $commande->id) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Valider cette commande?')">
                                        @csrf
                                        <button type="submit" 
                                                class="px-3 py-1 bg-green-500 text-white rounded-lg text-sm font-medium hover:bg-green-600 transition flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Valider
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('employe.commandes.annuler', $commande->id) }}" 
                                          class="inline"
                                          onsubmit="return confirm('Annuler cette commande?')">
                                        @csrf
                                        <button type="submit" 
                                                class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Annuler
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12 text-gray-500">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-lg mb-2">Aucune commande trouvée</p>
                <p class="text-sm mb-6">Les commandes apparaîtront ici lorsqu'elles seront validées par les clients</p>
            </div>
            @endif
        </div>
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