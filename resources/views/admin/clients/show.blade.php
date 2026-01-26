@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Profil du client
                </h1>
                <p class="text-white/80 mt-2">
                    Détails du compte client {{ $client->name }}
                </p>
                <div class="flex items-center mt-4 gap-4">
                    <a href="{{ route('admin.clients.index') }}" class="text-white/90 hover:text-white flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Client Information -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Client Details Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Informations du client</h2>
                    <a href="{{ route('admin.clients.edit', $client) }}" 
                       class="flex items-center gap-2 bg-[#01B3BB] text-white px-4 py-2 rounded-xl hover:bg-[#008D94] transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                        Modifier le profil
                    </a>
                </div>

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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">
                                Nom complet
                            </label>
                            <p class="text-lg font-semibold text-gray-800">{{ $client->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">
                                Adresse email
                            </label>
                            <p class="text-lg font-semibold text-gray-800">{{ $client->email }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">
                                Date d'inscription
                            </label>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $client->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">
                                Statut du compte
                            </label>
                            <div class="flex items-center">
                                @if($client->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mr-3">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Actif
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 mr-3">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Désactivé
                                </span>
                                <form method="POST" action="{{ route('admin.clients.toggle', $client) }}" 
                                      class="inline"
                                      onsubmit="return confirm('Voulez-vous vraiment activer ce client ?')">
                                    @csrf
                                    <button type="submit" 
                                            class="text-sm text-green-600 hover:text-green-800 hover:underline">
                                        Activer le compte
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">
                                Dernière mise à jour
                            </label>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $client->updated_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Orders -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-[#FFC62A] text-[#1E1E1E] px-6 py-4">
                    <h2 class="text-xl font-bold">Historique des commandes</h2>
                </div>
                
                <div class="p-6">
                    @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Commande</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Date</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Montant</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4 font-mono">#{{ $order->id }}</td>
                                    <td class="py-4 px-4">{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 px-4 font-semibold">{{ number_format($order->total, 3) }} dt</td>
                                    <td class="py-4 px-4">
                                        @php
                                            $statusColors = [
                                                'panier' => 'bg-gray-100 text-gray-800',
                                                'en_attente' => 'bg-yellow-100 text-yellow-800',
                                                'validee' => 'bg-green-100 text-green-800',
                                                'annulee' => 'bg-red-100 text-red-800',
                                                'livree' => 'bg-blue-100 text-blue-800'
                                            ];
                                            $statusText = [
                                                'panier' => 'Panier',
                                                'en_attente' => 'En attente',
                                                'validee' => 'Validée',
                                                'annulee' => 'Annulée',
                                                'livree' => 'Livrée'
                                            ];
                                        @endphp
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusColors[$order->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusText[$order->statut] ?? $order->statut }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <a href="{{ route('admin.commandes.show', $order->id) }}" 
                                           class="text-sm text-[#01B3BB] hover:underline">
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($orders->count() >= 10)
                    <div class="mt-4 text-center">
                        <a href="{{ route('admin.commandes.index') }}?client={{ $client->id }}" 
                           class="text-[#01B3BB] hover:underline">
                            Voir toutes les commandes →
                        </a>
                    </div>
                    @endif
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="text-lg mb-2">Aucune commande</p>
                        <p class="text-sm">Ce client n'a pas encore passé de commande</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Client Profile Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $client->name }}</h3>
                    <p class="text-gray-600">Client</p>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $client->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $client->is_active ? '● Actif' : '● Inactif' }}
                        </span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">ID</span>
                        <span class="font-medium">{{ $client->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Commandes</span>
                        <span class="font-medium">
                            {{ App\Models\Commande::where('user_id', $client->id)->where('statut', '!=', 'panier')->count() }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total dépensé</span>
                        <span class="font-medium">
                            {{ number_format(App\Models\Commande::where('user_id', $client->id)->where('statut', 'validee')->sum('total'), 3) }} dt
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Inscrit depuis</span>
                        <span class="font-medium">{{ $client->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.clients.edit', $client) }}" 
                       class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#FFC62A]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Modifier le profil</span>
                            <span class="text-sm text-gray-500">Éditer les informations</span>
                        </div>
                    </a>
                    
                    <form method="POST" action="{{ route('admin.clients.toggle', $client) }}" 
                          onsubmit="return confirm('Voulez-vous vraiment {{ $client->is_active ? 'désactiver' : 'activer' }} ce client ?')">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center p-3 rounded-xl hover:bg-gray-100 transition
                                       {{ $client->is_active ? 'bg-red-50 hover:bg-red-100' : 'bg-green-50 hover:bg-green-100' }}">
                            <div class="w-10 h-10 {{ $client->is_active ? 'bg-red-100' : 'bg-green-100' }} rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 {{ $client->is_active ? 'text-red-600' : 'text-green-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                    @if($client->is_active)
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    @else
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    @endif
                                </svg>
                            </div>
                            <div>
                                <span class="font-medium block {{ $client->is_active ? 'text-red-700' : 'text-green-700' }}">
                                    {{ $client->is_active ? 'Désactiver le compte' : 'Activer le compte' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $client->is_active ? 'Empêche la connexion' : 'Permet la connexion' }}
                                </span>
                            </div>
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.clients.index') }}" 
                       class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Retour à la liste</span>
                            <span class="text-sm text-gray-500">Voir tous les clients</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection