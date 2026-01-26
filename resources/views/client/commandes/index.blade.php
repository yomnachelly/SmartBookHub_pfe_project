@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold text-white">
                    Mes Commandes
                </h1>
                <p class="text-white/80 mt-2 max-w-2xl">
                    Historique complet de toutes vos commandes
                </p>
                <div class="flex flex-wrap items-center mt-4 gap-3">
                    <span class="text-white/90 text-sm">
                        Total dépensé: <span class="font-bold">{{ number_format($commandes->sum('total'), 3, '.', ' ') }} dt</span>
                    </span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('welcome') }}" 
                   class="flex items-center gap-2 bg-white text-[#01B3BB] px-5 py-3 rounded-xl font-medium hover:bg-white/90 transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Retour à la boutique
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Toutes vos commandes</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $commandes->total() }} commande(s) trouvée(s)</p>
                </div>
                <div class="mt-3 sm:mt-0">
                    <form method="GET" class="flex gap-2">
                        <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="validee" {{ request('status') == 'validee' ? 'selected' : '' }}>Validée</option>
                            <option value="annulee" {{ request('status') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                        </select>
                        <button type="submit" class="bg-[#01B3BB] text-white px-4 py-2 rounded-lg hover:bg-[#008D94] transition text-sm">
                            Filtrer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @if($commandes->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">N° Commande</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Date</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Articles</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Total</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Statut</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($commandes as $commande)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4">
                                <span class="font-mono text-sm font-medium text-gray-900">#ORD-{{ str_pad($commande->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-sm text-gray-600">{{ $commande->created_at->format('d/m/Y') }}</span>
                                <div class="text-xs text-gray-400">{{ $commande->created_at->format('H:i') }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-sm text-gray-600">
                                    {{ $commande->livres->count() ?? 0 }} article(s)
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-medium text-gray-900">{{ number_format($commande->total, 3, '.', ' ') }} dt</span>
                            </td>
                            <td class="py-3 px-4">
                                @php
                                    $statusClasses = [
                                        'en_attente' => 'bg-yellow-100 text-yellow-800',
                                        'validee' => 'bg-green-100 text-green-800',
                                        'annulee' => 'bg-red-100 text-red-800',
                                        'panier' => 'bg-blue-100 text-blue-800',
                                    ];
                                    $statusText = [
                                        'en_attente' => 'En attente',
                                        'validee' => 'Validée',
                                        'annulee' => 'Annulée',
                                        'panier' => 'En panier',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses[$commande->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusText[$commande->statut] ?? $commande->statut }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('client.commandes.show', $commande) }}" 
                                       class="p-1.5 hover:bg-blue-50 rounded-lg transition text-blue-600 hover:text-blue-700"
                                       title="Voir les détails">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    @if($commande->statut == 'validee')
                                    <a href="{{ route('commandes.facture', $commande) }}" 
                                       class="p-1.5 hover:bg-green-50 rounded-lg transition text-green-600 hover:text-green-700"
                                       title="Télécharger la facture">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($commandes->hasPages())
            <div class="mt-6 pt-6 border-t border-gray-200">
                {{ $commandes->links() }}
            </div>
            @endif
            
            @else
            <div class="text-center py-8">
                <div class="flex flex-col items-center justify-center text-gray-400">
                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <p class="text-gray-500 mb-2">Vous n'avez pas encore passé de commande</p>
                    <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 text-[#01B3BB] hover:text-[#008D94] font-medium transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Explorer la boutique
                    </a>
                </div>
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
    
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
</style>
@endsection