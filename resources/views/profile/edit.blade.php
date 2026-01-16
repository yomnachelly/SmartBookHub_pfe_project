@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#1E1E1E]">Éditer le profil</h1>
        <p class="text-gray-600 mt-2">Mettez à jour vos informations personnelles</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-[#01B3BB] rounded-full flex items-center justify-center mr-4">
                        <span class="text-white text-xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">{{ Auth::user()->name }}</h4>
                        <p class="text-gray-500 text-sm">Membre depuis {{ Auth::user()->created_at->format('M Y') }}</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center p-3 bg-[#FFC62A] text-[#1E1E1E] rounded-xl font-medium">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        Informations personnelles
                    </a>
                    <a href="#" class="flex items-center p-3 text-gray-600 hover:bg-gray-50 rounded-xl transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        Sécurité
                    </a>
                    <a href="#" class="flex items-center p-3 text-gray-600 hover:bg-gray-50 rounded-xl transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        Commandes
                    </a>
                </nav>
            </div>

            <!-- Back to Dashboard -->
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="flex items-center text-[#01B3BB] hover:text-[#FFC62A] transition">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour au tableau de bord
                </a>
            </div>
        </div>

        <!-- Right Column - Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet
                            </label>
                            <input id="name" 
                                   name="name" 
                                   type="text" 
                                   value="{{ old('name', Auth::user()->name) }}"
                                   required 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                                   placeholder="Votre nom">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   value="{{ old('email', Auth::user()->email) }}"
                                   required 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                                   placeholder="votre@email.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Fields (optional) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input id="phone" 
                                   name="phone" 
                                   type="tel" 
                                   value="{{ old('phone', Auth::user()->phone ?? '') }}"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                                   placeholder="+216 XX XXX XXX">
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse
                            </label>
                            <input id="address" 
                                   name="address" 
                                   type="text" 
                                   value="{{ old('address', Auth::user()->address ?? '') }}"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                                   placeholder="Votre adresse">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                @if (session('status') === 'profile-updated')
                                    <p class="text-sm text-green-600">
                                        Profil mis à jour avec succès!
                                    </p>
                                @endif
                            </div>
                            <div class="flex gap-4">
                                <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                                    Annuler
                                </a>
                                <button type="submit" class="px-6 py-3 bg-[#FFC62A] text-[#1E1E1E] font-medium rounded-xl hover:bg-[#FFD666] transition">
                                    Sauvegarder
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Delete Account Section (optional) -->
            <div class="mt-6 bg-red-50 border border-red-200 rounded-2xl p-6">
                <h3 class="text-lg font-bold text-red-700 mb-2">Zone de danger</h3>
                <p class="text-red-600 text-sm mb-4">
                    Supprimer votre compte est une action permanente et irréversible.
                    Toutes vos données seront définitivement effacées.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte? Cette action est irréversible.')"
                            class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                        Supprimer mon compte
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection