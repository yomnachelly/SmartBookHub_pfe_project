@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Bonjour, {{ Auth::user()->name }}!
                </h1>
                <p class="text-white/80 mt-2">
                    Bienvenue sur votre tableau de bord Yeda
                </p>
            </div>
        </div>
    </div>

    <!-- stats card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- total orders -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#FFC62A]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Commandes totales</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">12</h3>
                </div>
                <div class="w-12 h-12 bg-[#FFC62A]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">+2 cette semaine</span>
            </div>
        </div>

        <!-- wishlist -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#01B3BB]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Favoris</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">5</h3>
                </div>
                <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-gray-600">Livres sauvegardés</span>
            </div>
        </div>

        <!-- total spent -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#4ECFD7]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total dépensé</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">248.750 dt</h3>
                </div>
                <div class="w-12 h-12 bg-[#4ECFD7]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#4ECFD7]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">Economie: 45 dt</span>
            </div>
        </div>
    </div>

    <!-- main -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- recent orders -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-[#01B3BB] text-white px-6 py-4">
                    <h2 class="text-xl font-bold">Dernières commandes</h2>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Commande</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Date</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4">#ORD-001</td>
                                    <td class="py-4 px-4">15 Jan 2024</td>
                                    <td class="py-4 px-4">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Livré
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">45.500 dt</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4">#ORD-002</td>
                                    <td class="py-4 px-4">12 Jan 2024</td>
                                    <td class="py-4 px-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            En transit
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">67.250 dt</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4">#ORD-003</td>
                                    <td class="py-4 px-4">10 Jan 2024</td>
                                    <td class="py-4 px-4">
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            En préparation
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">32.000 dt</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="#" class="text-[#01B3BB] hover:text-[#FFC62A] font-medium transition">
                            Voir toutes les commandes →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- quick actions + profile -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <a href="{{ route('welcome') }}" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                        </div>
                        <span class="font-medium">Explorer la boutique</span>
                    </a>
                    
                    <a href="#" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#FFC62A]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="font-medium">Mes favoris</span>
                    </a>
                    
                    <a href="#" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-10 h-10 bg-[#4ECFD7]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#4ECFD7]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                        </div>
                        <span class="font-medium">Mon panier</span>
                    </a>
                </div>
            </div>

            <!-- profile -->
            <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                        <div class="w-14 h-14 bg-[#FFC62A] rounded-full flex items-center justify-center">
                            <span class="text-[#1E1E1E] text-xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">{{ Auth::user()->name }}</h4>
                        <p class="text-white/80 text-sm">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-3 bg-white/10 rounded-xl hover:bg-white/20 transition">
                        <span>Éditer le profil</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between p-3 bg-white/10 rounded-xl hover:bg-white/20 transition">
                            <span>Déconnexion</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
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
    
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
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
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
</style>
@endsection