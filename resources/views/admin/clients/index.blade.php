@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Gestion des Clients
                </h1>
                <p class="text-white/80 mt-2">
                    Gérez tous les clients de la plateforme Smart Book Hub
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-white/90 hover:text-white flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <button onclick="exportClients('csv')" 
                            class="flex items-center gap-2 bg-white text-[#01B3BB] px-4 py-3 rounded-xl font-medium hover:bg-white/90 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                        </svg>
                        Exporter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Clients actifs</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $clients->where('is_active', true)->count() }} / {{ $clients->total() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Clients inactifs</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $clients->where('is_active', false)->count() }} / {{ $clients->total() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total clients</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $clients->total() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Nouveaux (30j)</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $newClientsCount }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
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

    <!-- Clients Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Liste des clients</h2>
                    <p class="text-gray-600 text-sm mt-1">
                        Affichage {{ $clients->firstItem() }}-{{ $clients->lastItem() }} sur {{ $clients->total() }} client(s)
                    </p>
                </div>
                
                <!-- Filters -->
                <div class="flex flex-wrap gap-3">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher un client..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                               id="searchInput">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    
                    <select class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                            id="statusFilter">
                        <option value="all">Tous les statuts</option>
                        <option value="active">Actifs seulement</option>
                        <option value="inactive">Inactifs seulement</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full" id="clientsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Client</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Contact</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Inscription</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Commandes</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Statut</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($clients as $client)
                    @php
                        $orderCount = App\Models\Commande::where('user_id', $client->id)
                            ->where('statut', '!=', 'panier')
                            ->count();
                    @endphp
                    <tr class="hover:bg-gray-50 transition client-row" 
                        data-name="{{ strtolower($client->name) }}"
                        data-email="{{ strtolower($client->email) }}"
                        data-status="{{ $client->is_active ? 'active' : 'inactive' }}">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900 block">{{ $client->name }}</span>
                                    <span class="text-sm text-gray-500">ID: {{ $client->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    <span class="text-sm">{{ $client->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <span class="text-sm text-gray-900 block">
                                    {{ $client->created_at->format('d/m/Y') }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $client->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $orderCount }} commande(s)
                                </span>
                                @if($orderCount > 0)
                                <span class="text-xs text-green-600">
                                    <svg class="w-3 h-3 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Client actif
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if($client->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Actif
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Inactif
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-wrap gap-2">
                                <!-- View Details Button -->
                                <a href="{{ route('admin.clients.show', $client) }}" 
                                   class="flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Profil
                                </a>
                                
                                <!-- Edit Button -->
                                <a href="{{ route('admin.clients.edit', $client) }}" 
                                   class="flex items-center gap-1 px-3 py-1.5 bg-[#FFC62A]/10 text-[#FFC62A] rounded-lg hover:bg-[#FFC62A]/20 transition text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                    Modifier
                                </a>
                                
                                <!-- Toggle Status Button -->
                                <form method="POST" action="{{ route('admin.clients.toggle', $client) }}" 
                                      class="inline" 
                                      onsubmit="return confirm('Voulez-vous vraiment {{ $client->is_active ? 'désactiver' : 'activer' }} ce client ?')">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center gap-1 px-3 py-1.5 rounded-lg transition text-sm 
                                                   {{ $client->is_active ? 'bg-red-50 text-red-700 hover:bg-red-100' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            @if($client->is_active)
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            @else
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            @endif
                                        </svg>
                                        {{ $client->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 px-6 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.223.447-.481.801-.78 1H22a2 2 0 002-2v-2a2 2 0 00-2-2h-1.28c-.299-.199-.557-.553-.78-1-.446-.894-1.048-1.5-1.78-1.5s-1.334.606-1.78 1.5c-.223.447-.481.801-.78 1H10a2 2 0 00-2 2v2a2 2 0 002 2h1.28c.299.199.557.553.78 1 .446.894 1.048 1.5 1.78 1.5s1.334-.606 1.78-1.5c.223-.447.481-.801.78-1H22a2 2 0 002-2v-2a2 2 0 00-2-2h-1.28z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun client trouvé</h3>
                                <p class="text-gray-500 mb-4">Aucun client n'est inscrit sur la plateforme</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($clients->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Affichage de 
                    <span class="font-medium">{{ $clients->firstItem() }}</span>
                    à 
                    <span class="font-medium">{{ $clients->lastItem() }}</span>
                    sur 
                    <span class="font-medium">{{ $clients->total() }}</span>
                    clients
                </div>
                
                <div class="flex items-center space-x-2">
                    {{-- Previous Page Link --}}
                    @if ($clients->onFirstPage())
                    <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                        &laquo;
                    </span>
                    @else
                    <a href="{{ $clients->previousPageUrl() }}" 
                       class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        &laquo;
                    </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
                        @if ($page == $clients->currentPage())
                        <span class="px-3 py-1 bg-[#01B3BB] text-white rounded-lg">
                            {{ $page }}
                        </span>
                        @else
                        <a href="{{ $url }}" 
                           class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                            {{ $page }}
                        </a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($clients->hasMorePages())
                    <a href="{{ $clients->nextPageUrl() }}" 
                       class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        &raquo;
                    </a>
                    @else
                    <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                        &raquo;
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Search
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.client-row');
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const rows = document.querySelectorAll('.client-row');
        
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'all' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function exportClients(format) {
        alert(`Export des clients en format ${format}...`);
    }
</script>

<style>
    .client-row {
        transition: all 0.2s ease;
    }
    
    .client-row:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection