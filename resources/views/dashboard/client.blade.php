@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold text-white">
                    Bonjour, {{ Auth::user()->name }}!
                </h1>
                <p class="text-white/80 mt-2 max-w-2xl">
                    Bienvenue sur votre espace personnel Smart Book Hub
                </p>
                <div class="flex flex-wrap items-center mt-4 gap-3">
                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-sm font-medium">Client</span>
                    <span class="text-white/60 text-sm hidden md:inline">•</span>
                    <span class="text-white/90 text-sm">Membre depuis {{ Auth::user()->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('welcome') }}" 
                   class="flex items-center gap-2 bg-white text-[#01B3BB] px-5 py-3 rounded-xl font-medium hover:bg-white/90 transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Explorer la boutique
                </a>
                <a href="{{ route('panier.index') }}" 
                   class="flex items-center gap-2 bg-[#FFC62A] text-[#1E1E1E] px-5 py-3 rounded-xl font-medium hover:bg-[#FFD666] transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                    Voir mon panier
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Votre activité</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- total orders -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#FFC62A] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Commandes totales</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ $totalCommandes }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    @if($orderChange > 0)
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            +{{ $orderChange }} cette semaine
                        </span>
                    @elseif($orderChange < 0)
                        <span class="text-sm text-red-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            {{ $orderChange }} cette semaine
                        </span>
                    @else
                        <span class="text-sm text-gray-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                            Stable cette semaine
                        </span>
                    @endif
                </div>
            </div>

            <!-- wishlist -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#01B3BB] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Favoris</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ $wishlistCount }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <span class="text-sm text-gray-600 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
                        </svg>
                        {{ $wishlistCount }} livres sauvegardés
                    </span>
                </div>
            </div>

            <!-- total spent -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#4ECFD7] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total dépensé</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ number_format($totalDépensé, 3, '.', ' ') }} dt</h3>
                    </div>
                    <div class="w-12 h-12 bg-[#4ECFD7]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#4ECFD7]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <span class="text-sm text-green-600 font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.2 6.5 10.266a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/>
                        </svg>
                        Économie totale: 45 dt
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Recent Orders -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Dernières commandes</h2>
                        <p class="text-gray-600 text-sm mt-1">Historique de vos commandes récentes</p>
                    </div>
                    <a href="{{ route('client.commandes.index') }}" 
                       class="mt-3 sm:mt-0 inline-flex items-center gap-2 text-[#01B3BB] hover:text-[#008D94] font-medium transition">
                        Voir toutes les commandes
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
                <div class="p-6">
                    @if($commandes->count() > 0)
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">N° Commande</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Date</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($commandes as $commande)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <span class="font-mono text-sm font-medium text-gray-900">#ORD-{{ str_pad($commande->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="text-sm text-gray-600">{{ $commande->created_at->format('d M Y') }}</span>
                                        <div class="text-xs text-gray-400">{{ $commande->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="py-3 px-4">
                                        @php
                                            $statusClasses = [
                                                'en_attente' => 'bg-yellow-100 text-yellow-800',
                                                'validee' => 'bg-green-100 text-green-800',
                                                'annulee' => 'bg-red-100 text-red-800',
                                                'en_panier' => 'bg-blue-100 text-blue-800',
                                            ];
                                            $statusText = [
                                                'en_attente' => 'En attente',
                                                'validee' => 'Validée',
                                                'annulee' => 'Annulée',
                                                'en_panier' => 'En panier',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses[$commande->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusText[$commande->statut] ?? $commande->statut }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="font-medium text-gray-900">{{ number_format($commande->total, 3, '.', ' ') }} dt</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

        <!-- Right Column - Sidebar -->
        <div class="space-y-8">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] text-white px-6 py-4">
                    <h2 class="text-xl font-bold">Actions rapides</h2>
                    <p class="text-white/80 text-sm mt-1">Accès direct à vos fonctionnalités</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <a href="{{ route('welcome') }}" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#01B3BB]/5 hover:border-[#01B3BB]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#01B3BB]/20 transition">
                                <svg class="w-6 h-6 text-[#01B3BB] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#01B3BB] transition">Explorer la boutique</span>
                                <span class="text-sm text-gray-500">Découvrir nos livres</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#01B3BB] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>

                        <a href="{{ route('client.wishlist') }}" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#FFC62A]/5 hover:border-[#FFC62A]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#FFC62A]/20 transition">
                                <svg class="w-6 h-6 text-[#FFC62A] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#FFC62A] transition">Mes favoris</span>
                                <span class="text-sm text-gray-500">{{ $wishlistCount }} livres sauvegardés</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#FFC62A] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>

                        <a href="{{ route('panier.index') }}" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#4ECFD7]/5 hover:border-[#4ECFD7]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#4ECFD7]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#4ECFD7]/20 transition">
                                <svg class="w-6 h-6 text-[#4ECFD7] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#4ECFD7] transition">Mon panier</span>
                                <span class="text-sm text-gray-500">Voir mes articles</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#4ECFD7] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
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
    
    .progress-bar {
        transition: width 0.6s ease;
    }
    
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    .group:hover .group-hover\:opacity-100 {
        opacity: 1;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderStatuses = document.querySelectorAll('[data-order-status]');
        orderStatuses.forEach(status => {
            const statusText = status.textContent.trim();
            if (statusText === 'En attente') {
                status.classList.add('animate-pulse');
            }
        });
    });
</script>
@endsection