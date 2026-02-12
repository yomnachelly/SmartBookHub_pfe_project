@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#1E1E1E]">Éditer le profil</h1>
        <p class="text-gray-600 mt-2">Mettez à jour vos informations personnelles et votre mot de passe</p>
    </div>

    <!-- Status Messages -->
    @if (session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <p class="text-green-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Profil mis à jour avec succès!
            </p>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <p class="text-green-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Mot de passe mis à jour avec succès! Un email de confirmation vous a été envoyé.
            </p>
        </div>
    @endif

    @if (session('warning'))
        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
            <p class="text-yellow-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('warning') }}
            </p>
        </div>
    @endif

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
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mt-1
                            {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                              (Auth::user()->role === 'employe' ? 'bg-blue-100 text-blue-800' : 
                              (Auth::user()->role === 'client' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) }}">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="#profile-info" 
                       class="flex items-center p-3 bg-[#FFC62A] text-[#1E1E1E] rounded-xl font-medium">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        Informations personnelles
                    </a>
                    <a href="#password-section" 
                       class="flex items-center p-3 hover:bg-gray-100 text-gray-700 rounded-xl transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        Mot de passe
                    </a>
                    <a href="#danger-zone" 
                       class="flex items-center p-3 hover:bg-red-50 text-red-600 rounded-xl transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Zone de danger
                    </a>
                </nav>
            </div>

            <div class="mt-6">
                @php
                    $dashboardRoute = 'dashboard';
                    $dashboardText = 'Retour au tableau de bord';
                    
                    if (Auth::user()->role === 'admin') {
                        $dashboardRoute = 'admin.dashboard';
                        $dashboardText = 'Retour au tableau de bord Admin';
                    } elseif (Auth::user()->role === 'employe') {
                        $dashboardRoute = 'employe.dashboard';
                        $dashboardText = 'Retour au tableau de bord Employé';
                    } elseif (Auth::user()->role === 'client') {
                        $dashboardRoute = 'client.dashboard';
                        $dashboardText = 'Retour au tableau de bord Client';
                    }
                @endphp
                
                <a href="{{ route($dashboardRoute) }}" class="flex items-center text-[#01B3BB] hover:text-[#FFC62A] transition">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ $dashboardText }}
                </a>
            </div>
        </div>

        <!-- Right Column - Forms -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Profile Information Form -->
            <div id="profile-info" class="bg-white rounded-2xl shadow-lg p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-[#1E1E1E]">Informations personnelles</h2>
                    <p class="text-gray-600 mt-1">Mettez à jour vos informations de profil</p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet <span class="text-red-500">*</span>
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
                                Email <span class="text-red-500">*</span>
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

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input id="phone" 
                                   name="phone" 
                                   type="tel" 
                                   value="{{ old('phone', Auth::user()->phone) }}"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                                   placeholder="+216 XX XXX XXX">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse
                            </label>
                            <input id="address" 
                                   name="address" 
                                   type="text" 
                                   value="{{ old('address', Auth::user()->address) }}"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                                   placeholder="Votre adresse">
                            @error('address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-[#FFC62A] text-[#1E1E1E] font-medium rounded-xl hover:bg-[#FFB80A] transition flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Password Update Form -->
            <div id="password-section" class="bg-white rounded-2xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-[#1E1E1E]">Changer le mot de passe</h3>
                    <p class="text-gray-600 mt-1">Assurez-vous d'utiliser un mot de passe long et aléatoire pour rester en sécurité</p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-6">
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Mot de passe actuel <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input id="current_password" 
                                       name="current_password" 
                                       type="password" 
                                       autocomplete="current-password"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition pr-12"
                                       placeholder="Votre mot de passe actuel">
                                <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Nouveau mot de passe <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       name="password" 
                                       type="password" 
                                       autocomplete="new-password"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition pr-12"
                                       placeholder="Votre nouveau mot de passe">
                                <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirmer le mot de passe <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" 
                                       name="password_confirmation" 
                                       type="password" 
                                       autocomplete="new-password"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition pr-12"
                                       placeholder="Confirmez votre nouveau mot de passe">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <h4 class="text-sm font-medium text-blue-900 mb-2">💡 Conseils pour un mot de passe sécurisé :</h4>
                        <ul class="text-xs text-blue-800 space-y-1">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Au moins 8 caractères
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Combinez lettres majuscules et minuscules
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Incluez des chiffres et caractères spéciaux
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-[#01B3BB] text-white font-medium rounded-xl hover:bg-[#019BA3] transition flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Mettre à jour le mot de passe
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div id="danger-zone" class="bg-red-50 border-2 border-red-200 rounded-2xl p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-red-700 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Zone de danger
                    </h3>
                    <p class="text-red-600 mt-2">
                        Supprimer votre compte est une action permanente et irréversible. Toutes vos données seront définitivement effacées.
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('⚠️ ATTENTION!\n\nÊtes-vous absolument sûr de vouloir supprimer votre compte?\n\nCette action est IRRÉVERSIBLE et supprimera:\n• Toutes vos informations personnelles\n• Votre historique de commandes\n• Votre liste de favoris\n• Toutes vos données\n\nTapez OK pour confirmer la suppression définitive.')"
                            class="px-6 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Supprimer mon compte définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    if (field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}

// Smooth scroll to sections
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endsection