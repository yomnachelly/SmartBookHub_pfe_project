@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold text-white">
                    Tableau de bord Employé
                </h1>
                <p class="text-white/80 mt-2 max-w-2xl">
                    Gestion opérationnelle de la plateforme Smart Book Hub
                </p>
                <div class="flex flex-wrap items-center mt-4 gap-3">
                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-sm font-medium">Employé</span>
                    <span class="text-white/60 text-sm hidden md:inline">•</span>
                    <span class="text-white/90 text-sm">Dernière connexion: {{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <button class="flex items-center gap-2 bg-white text-[#01B3BB] px-5 py-3 rounded-xl font-medium hover:bg-white/90 transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                    </svg>
                    Exporter rapport
                </button>
                <button class="flex items-center gap-2 bg-[#FFC62A] text-[#1E1E1E] px-5 py-3 rounded-xl font-medium hover:bg-[#FFD666] transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Nouvelle action
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Aperçu rapide</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- total users -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#FFC62A] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Utilisateurs totaux</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ $totalUsers }}</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $newUsersThisMonth }} nouveaux
                            </span>
                            <span class="text-gray-500 text-sm ml-2">ce mois</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- total orders -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#01B3BB] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Commandes totales</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ $totalOrders }}</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $newOrdersThisMonth }} nouvelles
                            </span>
                            <span class="text-gray-500 text-sm ml-2">ce mois</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- total revenue -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#4ECFD7] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Revenu total</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ number_format($totalRevenue, 3) }} dt</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ number_format($revenueThisMonth, 3) }} dt
                            </span>
                            <span class="text-gray-500 text-sm ml-2">ce mois</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-[#4ECFD7]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#4ECFD7]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- total books -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#FF6B6B] hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Livres en stock</p>
                        <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">{{ $totalBooks }}</h3>
                        <div class="flex items-center mt-2">
                            @if($lowStockBooks > 0)
                            <span class="text-red-600 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $lowStockBooks }} livres
                            </span>
                            <span class="text-gray-500 text-sm ml-2">stock bas</span>
                            @else
                            <span class="text-green-600 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Stock OK
                            </span>
                            <span class="text-gray-500 text-sm ml-2">tous en stock</span>
                            @endif
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-[#FF6B6B]/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#FF6B6B]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Main Activities -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Quick Actions Panel -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#FFC62A] to-[#FFD666] text-[#1E1E1E] px-6 py-4">
                    <h2 class="text-xl font-bold">Actions rapides</h2>
                    <p class="text-[#1E1E1E]/80 text-sm mt-1">Accès direct aux principales fonctionnalités employé</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('employe.clients.index') }}" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#01B3BB]/5 hover:border-[#01B3BB]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#01B3BB]/20 transition">
                                <svg class="w-6 h-6 text-[#01B3BB] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#01B3BB] transition">Clients</span>
                                <span class="text-sm text-gray-500">Gérer les utilisateurs</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#01B3BB] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>

                        <a href="{{ route('employee.books.index') }}" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#FFC62A]/5 hover:border-[#FFC62A]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#FFC62A]/20 transition">
                                <svg class="w-6 h-6 text-[#FFC62A] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#FFC62A] transition">Livres</span>
                                <span class="text-sm text-gray-500">Gérer le catalogue</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#FFC62A] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>

                        <a href="{{ route('employe.commandes.index') }}" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#4ECFD7]/5 hover:border-[#4ECFD7]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#4ECFD7]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#4ECFD7]/20 transition">
                                <svg class="w-6 h-6 text-[#4ECFD7] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13L5.5 6H19M7 13l-2 5m2-5h12m-4 0v5" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#4ECFD7] transition">Commandes</span>
                                <span class="text-sm text-gray-500">Suivi des commandes</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#4ECFD7] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>

                        <a href="#" class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-[#FF6B6B]/5 hover:border-[#FF6B6B]/20 border-2 border-transparent transition-all duration-300">
                            <div class="w-12 h-12 bg-[#FF6B6B]/10 rounded-lg flex items-center justify-center mr-4 group-hover:bg-[#FF6B6B]/20 transition">
                                <svg class="w-6 h-6 text-[#FF6B6B] group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 block group-hover:text-[#FF6B6B] transition">Analytiques</span>
                                <span class="text-sm text-gray-500">Rapports financiers</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#FF6B6B] transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Commandes récentes</h2>
                        <p class="text-gray-600 text-sm mt-1">Les dernières commandes à traiter</p>
                    </div>
                    <a href="{{ route('employe.commandes.index') }}" 
                       class="mt-3 sm:mt-0 inline-flex items-center gap-2 text-[#01B3BB] hover:text-[#008D94] font-medium transition">
                        Voir toutes les commandes
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
                <div class="p-6">
                    @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">ID Commande</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Client</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Date</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Montant</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($recentOrders as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <span class="font-mono text-sm font-medium text-gray-900">#ORD-{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-purple-500/10 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-purple-600 text-xs font-bold">
                                                    {{ strtoupper(substr($order->nom_client, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="text-sm text-gray-800">{{ $order->nom_client }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="text-sm text-gray-600">{{ $order->created_at->format('d/m/Y') }}</span>
                                        <div class="text-xs text-gray-400">{{ $order->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="font-medium text-gray-900">{{ number_format($order->total, 3) }} dt</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @php
                                            $colors = [
                                                'en_attente' => 'bg-yellow-100 text-yellow-800',
                                                'validee' => 'bg-green-100 text-green-800',
                                                'annulee' => 'bg-red-100 text-red-800',
                                                'en_panier' => 'bg-gray-100 text-gray-800'
                                            ];
                                            $statusLabels = [
                                                'en_attente' => 'En attente',
                                                'validee' => 'Validée',
                                                'annulee' => 'Annulée',
                                                'en_panier' => 'En panier'
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $colors[$order->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusLabels[$order->statut] ?? $order->statut }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('employe.commandes.show', $order->id) }}" 
                                               class="p-1.5 hover:bg-blue-50 rounded-lg transition text-blue-600 hover:text-blue-700"
                                               title="Voir les détails">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('employe.commandes.edit', $order->id) }}" 
                                               class="p-1.5 hover:bg-yellow-50 rounded-lg transition text-yellow-600 hover:text-yellow-700"
                                               title="Modifier">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                </svg>
                                            </a>
                                        </div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-gray-500">Aucune commande récente</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-8">
            <!-- Recent Clients -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] text-white px-6 py-4">
                    <h2 class="text-xl font-bold">Clients récents</h2>
                    <p class="text-white/80 text-sm mt-1">Les derniers clients inscrits</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-gray-600">{{ $recentClients->count() }} client(s)</span>
                        <a href="{{ route('employe.clients.index') }}" 
                           class="text-[#01B3BB] hover:text-[#008D94] text-sm font-medium transition">
                            Gérer les clients →
                        </a>
                    </div>
                    
                    @if($recentClients->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentClients->take(5) as $client)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900 block">{{ $client->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $client->email }}</span>
                                </div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                @if($client->is_active)
                                <span class="inline-flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                    <span class="text-xs text-green-600 font-medium">Actif</span>
                                </span>
                                @else
                                <span class="inline-flex items-center">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                    <span class="text-xs text-red-600 font-medium">Inactif</span>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-6">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-gray-500">Aucun client récent</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Stock Alerts -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#FF6B6B] to-[#FF8E8E] text-white px-6 py-4">
                    <h2 class="text-xl font-bold">Alertes stock</h2>
                    <p class="text-white/90 text-sm mt-1">Livres nécessitant réapprovisionnement</p>
                </div>
                <div class="p-6">
                    @if($lowStockAlerts->count() > 0)
                    <div class="space-y-3">
                        @foreach($lowStockAlerts->take(4) as $book)
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-100">
                            <div>
                                <p class="text-sm font-medium text-gray-800 truncate">{{ $book->titre }}</p>
                                <p class="text-xs text-gray-600">Stock: {{ $book->stock }} unités</p>
                            </div>
                            <a href="{{ route('employee.books.edit', $book->id_livre) }}" 
                               class="text-red-600 hover:text-red-800 text-sm font-medium whitespace-nowrap">
                                Réapprovisionner
                            </a>
                        </div>
                        @endforeach
                        
                        @if($lowStockAlerts->count() > 4)
                        <div class="text-center pt-3">
                            <a href="{{ route('employee.books.index') }}?filter=low_stock" 
                               class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Voir toutes les alertes →
                            </a>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="text-center py-6">
                        <div class="w-16 h-16 mx-auto bg-green-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium">Aucune alerte stock bas</p>
                        <p class="text-sm text-gray-500 mt-1">Tous les livres sont bien en stock</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Activité récente</h3>
                <div class="space-y-4">
                    @foreach($recentActivities as $activity)
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 
                            @if($activity['type'] == 'success') bg-green-100 text-green-600
                            @elseif($activity['type'] == 'warning') bg-yellow-100 text-yellow-600
                            @else bg-[#FFC62A]/20 text-[#FFC62A] @endif">
                            @if($activity['type'] == 'success')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            @elseif($activity['type'] == 'warning')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            @else
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-800 truncate">
                                {{ $activity['message'] }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $activity['time'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                    
                    @if(empty($recentActivities))
                    <div class="text-center py-4 text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm">Aucune activité récente</p>
                    </div>
                    @endif
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
    
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh dashboard data every 60 seconds
        setInterval(function() {
            console.log('Refreshing employee dashboard data...');
        }, 60000);
        
        // Stock alert notifications
        const stockAlerts = document.querySelectorAll('[data-stock-alert]');
        if (stockAlerts.length > 0) {
            console.log(`${stockAlerts.length} livre(s) nécessitent réapprovisionnement`);
        }
        
        // Highlight pending orders
        const pendingOrders = document.querySelectorAll('[data-order-status="en_attente"]');
        if (pendingOrders.length > 0) {
            console.log(`${pendingOrders.length} commande(s) en attente de traitement`);
        }
    });
</script>
@endsection