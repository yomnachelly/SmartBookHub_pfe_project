@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">
                    Gestion des clients
                </h1>
                <p class="text-white/80 mt-1">
                    Liste de tous les clients de Smart Book Hub
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('employe.dashboard') }}" 
                   class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition">
                    ← Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>

    <!-- clients Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-[#FFC62A] text-[#1E1E1E] px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold">Liste des clients ({{ $clients->total() }})</h2>
            <div class="relative">
                <form action="{{ route('employe.clients.index') }}" method="GET" class="flex gap-2">
                    <div class="relative">
                        <input type="text" 
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Rechercher un client..." 
                               class="pl-10 pr-4 py-2 rounded-lg bg-white/90 focus:outline-none focus:ring-2 focus:ring-[#01B3BB]">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button type="submit" class="bg-[#01B3BB] text-white px-4 py-2 rounded-lg hover:bg-[#0199A1] transition">
                        Rechercher
                    </button>
                    @if(request('search'))
                    <a href="{{ route('employe.clients.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                        Réinitialiser
                    </a>
                    @endif
                </form>
            </div>
        </div>
        
        <div class="p-6">
            @if($clients->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Client</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Email</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Inscription</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Commandes</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Statut</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <a href="{{ route('employe.clients.show', $client->id) }}" 
                                   class="flex items-center hover:text-[#01B3BB] transition">
                                    <div class="w-10 h-10 bg-[#01B3BB] rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm font-bold">
                                            {{ strtoupper(substr($client->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-medium">{{ $client->name }}</span>
                                        <p class="text-xs text-gray-500">ID: #CLT-{{ str_pad($client->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </a>
                            </td>
                            <td class="py-4 px-4">{{ $client->email }}</td>
                            <td class="py-4 px-4">
                                {{ $client->created_at->format('d/m/Y') }}
                                <p class="text-xs text-gray-500">{{ $client->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="py-4 px-4">
                                @php
                                    $orderCount = \App\Models\Commande::where('user_id', $client->id)
                                        ->where('statut', '!=', 'panier')
                                        ->count();
                                @endphp
                                <span class="font-medium">{{ $orderCount }}</span>
                                <p class="text-xs text-gray-500">commandes</p>
                            </td>
                            <td class="py-4 px-4">
                                @if($client->is_active)
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800">
                                        Actif
                                    </span>
                                @else
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-red-100 text-red-800">
                                        Inactif
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('employe.clients.show', $client->id) }}" 
                                       class="p-2 hover:bg-gray-100 rounded transition" 
                                       title="Voir le profil">
                                        <svg class="w-4 h-4 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('employe.clients.edit', $client->id) }}" 
                                       class="p-2 hover:bg-gray-100 rounded transition" 
                                       title="Modifier">
                                        <svg class="w-4 h-4 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('employe.clients.toggle-active', $client->id) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="p-2 hover:bg-gray-100 rounded transition" 
                                                title="{{ $client->is_active ? 'Désactiver' : 'Activer' }}">
                                            @if($client->is_active)
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            @else
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $clients->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-20 h-20 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-6A8.5 8.5 0 0012 3v1m0 0V3m0 1v1"/>
                </svg>
                <p class="text-gray-500 mt-4 text-lg">Aucun client trouvé</p>
                <p class="text-gray-400">Aucun client n'est inscrit sur la plateforme</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection