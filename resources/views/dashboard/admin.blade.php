@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Tableau de bord Admin
                </h1>
                <p class="text-white/80 mt-2">
                    Gestion complète de la plateforme Smart Book Hub
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">Administrateur</span>
                    <span class="text-white/60 text-sm">•</span>
                    <span class="text-white/80 text-sm">Dernière connexion: {{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <!-- quick actions -->
                <div class="flex gap-3">
                    <button class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                        </svg>
                        Exporter
                    </button>
                    <button class="bg-[#FFC62A] text-[#1E1E1E] px-4 py-2 rounded-xl font-medium hover:bg-[#FFD666] transition">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Nouveau
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- stats overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- total users -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#FFC62A]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Utilisateurs totaux</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">1,248</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+12%</span>
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
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#01B3BB]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Commandes totales</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">856</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+8%</span>
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
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#4ECFD7]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Revenu total</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">42.5K dt</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+15%</span>
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

        <!-- total products -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#FF6B6B]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Livres en stock</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">347</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-red-600 text-sm font-medium">-3%</span>
                        <span class="text-gray-500 text-sm ml-2">stock bas</span>
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

    <!-- main -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- recent orders & users -->
        <div class="lg:col-span-2 space-y-8">
            <!-- recent orders table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-[#01B3BB] text-white px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold">Commandes récentes</h2>
                    <a href="#" class="text-sm hover:text-[#FFC62A] transition">Voir tout →</a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">ID</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Client</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Date</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Montant</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 5; $i++)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4 font-mono">#ORD-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-4 px-4">Client {{ $i }}</td>
                                    <td class="py-4 px-4">{{ now()->subDays($i)->format('d/m/Y') }}</td>
                                    <td class="py-4 px-4 font-semibold">{{ number_format(rand(2000, 15000) / 100, 3) }} dt</td>
                                    <td class="py-4 px-4">
                                        @php
                                            $statuses = ['Livré', 'En transit', 'En préparation', 'En attente'];
                                            $status = $statuses[array_rand($statuses)];
                                            $colors = [
                                                'Livré' => 'bg-green-100 text-green-800',
                                                'En transit' => 'bg-blue-100 text-blue-800',
                                                'En préparation' => 'bg-yellow-100 text-yellow-800',
                                                'En attente' => 'bg-gray-100 text-gray-800'
                                            ];
                                        @endphp
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $colors[$status] }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex gap-2">
                                            <button class="p-1 hover:bg-gray-100 rounded transition" title="Voir">
                                                <svg class="w-4 h-4 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                            <button class="p-1 hover:bg-gray-100 rounded transition" title="Éditer">
                                                <svg class="w-4 h-4 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- employees management -->
            <div id="employes-section" class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-[#FFC62A] text-[#1E1E1E] px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold">Liste des employés</h2>
                    <a href="{{ route('admin.employees.create') }}" 
                       class="flex items-center gap-2 bg-[#01B3BB] text-white px-4 py-2 rounded-xl hover:bg-[#008D94] transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Nouvel employé
                    </a>
                </div>
                
                <!-- employees list -->
                <div class="p-6">
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

                    @if(isset($employees) && $employees->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Utilisateur</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Email</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Inscription</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-[#01B3BB] rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-xs font-bold">
                                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span>{{ $employee->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">{{ $employee->email }}</td>
                                    <td class="py-4 px-4">
                                        @if($employee->is_active ?? true)
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                        @else
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-red-100 text-red-800">
                                            Inactif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">{{ $employee->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 px-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.employees.edit', $employee) }}"
                                               class="text-xs px-3 py-1 bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition">
                                                Modifier
                                            </a>
                                            
                                            <form method="POST" action="{{ route('admin.employees.toggle', $employee) }}">
                                                @csrf
                                                <button type="submit" 
                                                        class="text-xs px-3 py-1 rounded-full {{ ($employee->is_active ?? true) ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }} transition">
                                                    {{ ($employee->is_active ?? true) ? 'Désactiver' : 'Activer' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.223.447-.481.801-.78 1H22a2 2 0 002-2v-2a2 2 0 00-2-2h-1.28c-.299-.199-.557-.553-.78-1-.446-.894-1.048-1.5-1.78-1.5s-1.334.606-1.78 1.5c-.223.447-.481.801-.78 1H10a2 2 0 00-2 2v2a2 2 0 002 2h1.28c.299.199.557.553.78 1 .446.894 1.048 1.5 1.78 1.5s1.334-.606 1.78-1.5c.223-.447.481-.801.78-1H22a2 2 0 002-2v-2a2 2 0 00-2-2h-1.28z" />
                        </svg>
                        <p class="text-lg mb-2">Aucun employé trouvé</p>
                        <p class="text-sm">Commencez par <a href="{{ route('admin.employees.create') }}" class="text-[#01B3BB] hover:underline">ajouter un nouvel employé</a></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- sidebar -->
        <div class="space-y-6">
            <!-- quick admin actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <a href="#clients-section" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Gérer les clients</span>
                            <span class="text-sm text-gray-500">verrouiller/déverrouiller</span>
                        </div>
                    </a>
                    
                    <a href="#employes-section" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Gérer les employés & les admins</span>
                            <span class="text-sm text-gray-500">Ajouter/éditer/supprimer</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.books.index') }}" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#FFC62A]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Gérer les livres</span>
                            <span class="text-sm text-gray-500">Ajouter/modifier/supprimer</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.commandes.index') }}" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
    <div class="w-10 h-10 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-3">
        <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13L5.5 6H19M7 13l-2 5m2-5h12m-4 0v5" />
        </svg>
    </div>
    <div>
        <span class="font-medium block">Gérer les commandes</span>
        <span class="text-sm text-gray-500">Voir/éditer les commandes</span>
    </div>
</a>

                    <a href="#" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#4ECFD7]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#4ECFD7]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">Analytiques financières</span>
                            <span class="text-sm text-gray-500">Voir les rapports</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- system status -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">État du système</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Stock</span>
                            <span class="text-sm font-medium text-[#01B3BB]">75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-[#01B3BB] h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Serveur</span>
                            <span class="text-sm font-medium text-green-600">100%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Base de données</span>
                            <span class="text-sm font-medium text-[#FFC62A]">92%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-[#FFC62A] h-2 rounded-full" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- system alerts -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        @if(isset($clients))
        <div id="clients-section" class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-[#01B3BB] text-white px-6 py-4">
                <h2 class="text-xl font-bold">Gestion des clients</h2>
            </div>

            <div class="p-6 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-3 px-4">Nom</th>
                            <th class="text-left py-3 px-4">Email</th>
                            <th class="text-left py-3 px-4">Statut</th>
                            <th class="text-left py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $client->name }}</td>
                            <td class="py-3 px-4">{{ $client->email }}</td>
                            <td class="py-3 px-4">
                                @if($client->is_active)
                                    <span class="text-green-600 font-semibold">Actif</span>
                                @else
                                    <span class="text-red-600 font-semibold">Verrouillé</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <form method="POST" action="{{ route('admin.clients.toggle', $client) }}">
                                    @csrf
                                    <button
                                        class="px-3 py-1 rounded text-white
                                        {{ $client->is_active ? 'bg-red-500' : 'bg-green-500' }}">
                                        {{ $client->is_active ? 'Verrouiller' : 'Déverrouiller' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- recent activity -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">Activité récente</h3>
            <div class="space-y-4">
                @for($i = 1; $i <= 3; $i++)
                <div class="flex items-start">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 
                        @if($i == 1) bg-green-100 text-green-600
                        @elseif($i == 2) bg-blue-100 text-blue-600
                        @else bg-[#FFC62A]/20 text-[#FFC62A] @endif">
                        @if($i == 1)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        @elseif($i == 2)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-800">
                            @if($i == 1)
                            Nouvelle commande #ORD-{{ rand(100, 999) }} traitée
                            @elseif($i == 2)
                            Notification système: Mise à jour requise
                            @else
                            Modification du livre "Mathématiques 6ème"
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ now()->subMinutes(rand(5, 120))->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- notifications -->
        <div class="bg-gradient-to-r from-[#FFC62A] to-[#FFD666] rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">Notifications</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-white/20 rounded-xl">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center mr-3">
                            <span class="text-[#FFC62A] text-sm font-bold">!</span>
                        </div>
                        <span class="text-[#1E1E1E] font-medium">5 commandes en attente</span>
                    </div>
                    <button class="text-[#01B3BB] text-sm hover:underline">Voir</button>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-white/20 rounded-xl">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center mr-3">
                            <span class="text-[#FFC62A] text-sm font-bold">!</span>
                        </div>
                        <span class="text-[#1E1E1E] font-medium">3 livres en rupture</span>
                    </div>
                    <button class="text-[#01B3BB] text-sm hover:underline">Réapprovisionner</button>
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
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // refreshing data every 60 seconds
        setInterval(function() {
            console.log('Refreshing admin data...');
        }, 60000);
        
        document.querySelectorAll('[data-export]').forEach(button => {
            button.addEventListener('click', function() {
                const type = this.dataset.export;
                alert(`Exporting ${type} data...`);
            });
        });
    });
</script>
@endsection