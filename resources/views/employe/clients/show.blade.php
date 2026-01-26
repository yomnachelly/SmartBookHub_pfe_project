@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                    <span class="text-[#01B3BB] text-2xl font-bold">
                        {{ strtoupper(substr($client->name, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        {{ $client->name }}
                    </h1>
                    <p class="text-white/80 mt-1">
                        ID: #CLT-{{ str_pad($client->id, 3, '0', STR_PAD_LEFT) }} • Client depuis {{ $client->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('employe.clients.index') }}" 
                   class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition">
                    ← Retour
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- profile -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 pb-2 border-b">Informations du client</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nom complet</p>
                        <p class="font-medium text-gray-800">{{ $client->name }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="font-medium text-gray-800">{{ $client->email }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Date d'inscription</p>
                        <p class="font-medium text-gray-800">{{ $client->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Statut</p>
                        @if($client->is_active)
                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800">
                                Actif
                            </span>
                        @else
                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-red-100 text-red-800">
                                Inactif
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- orders history -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-[#FFC62A] text-[#1E1E1E] px-6 py-4">
                    <h3 class="text-xl font-bold">Historique des commandes</h3>
                </div>
                <div class="p-6">
                    @if($commandes->count() > 0)
                    <div class="space-y-4">
                        @foreach($commandes as $commande)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-bold text-gray-800">
                                        #ORD-{{ str_pad($commande->id, 3, '0', STR_PAD_LEFT) }}
                                    </h4>
                                    <p class="text-sm text-gray-600">Date: {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-[#01B3BB]">{{ number_format($commande->total, 3) }} dt</p>
                                    @php
                                        $statusColors = [
                                            'en_attente' => 'bg-yellow-100 text-yellow-800',
                                            'validee' => 'bg-green-100 text-green-800',
                                            'annulee' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusLabels = [
                                            'en_attente' => 'En attente',
                                            'validee' => 'Validée',
                                            'annulee' => 'Annulée',
                                        ];
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusColors[$commande->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statusLabels[$commande->statut] ?? $commande->statut }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        {{ $commande->livres->count() }} article(s) • 
                                        Mode de paiement: {{ $commande->mode_paiement ?? 'Non spécifié' }}
                                    </p>
                                </div>
                                <a href="{{ route('employe.commandes.show', $commande->id) }}" 
                                   class="text-[#01B3BB] hover:text-[#0199A1] text-sm font-medium">
                                    Voir détails →
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13L5.5 6H19M7 13l-2 5m2-5h12m-4 0v5"/>
                        </svg>
                        <p class="text-gray-500 mt-4">Aucune commande passée</p>
                        <p class="text-sm text-gray-400">Ce client n'a pas encore passé de commande</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- sidebar -->
        <div class="space-y-6">
            <!-- stats -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">Statistiques</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Commandes totales</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $commandes->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total dépensé</p>
                            <p class="text-2xl font-bold text-[#01B3BB]">{{ number_format($totalSpent, 3) }} dt</p>
                        </div>
                        <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#01B3BB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Client depuis</p>
                            <p class="text-lg font-medium text-gray-800">{{ $client->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">Actions rapides</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('employe.clients.edit', $client->id) }}" 
                       class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#FFC62A]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Modifier le profil</span>
                            <span class="text-sm text-gray-500">Nom, email, statut</span>
                        </div>
                    </a>
                    
                    <form action="{{ route('employe.clients.toggle-active', $client->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="w-10 h-10 {{ $client->is_active ? 'bg-red-100' : 'bg-green-100' }} rounded-lg flex items-center justify-center mr-3">
                                @if($client->is_active)
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                @else
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                @endif
                            </div>
                            <div class="text-left">
                                <span class="font-medium block">
                                    {{ $client->is_active ? 'Désactiver le compte' : 'Activer le compte' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $client->is_active ? 'Rendre inactif' : 'Rendre actif' }}
                                </span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection