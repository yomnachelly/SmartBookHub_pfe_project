@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Modifier l'employé
                </h1>
                <p class="text-white/80 mt-2">
                    Modifiez les informations de {{ $employee->name }}
                </p>
                <div class="flex items-center mt-4 gap-4">
                    <a href="{{ route('admin.employees.index') }}" class="text-white/90 hover:text-white flex items-center gap-2">
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
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Informations de l'employé</h2>
                
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

                @if(session('warning'))
                <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-yellow-700">{{ session('warning') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-red-700 font-medium">Veuillez corriger les erreurs suivantes:</p>
                            <ul class="text-red-600 text-sm mt-1 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.employees.update', $employee) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Informations personnelles</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nom complet *
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $employee->name) }}"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Adresse email *
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $employee->email) }}"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                                </div>
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nouveau mot de passe
                                    <span class="text-gray-400 font-normal">(laissez vide pour ne pas modifier)</span>
                                </label>
                                <input type="password" 
                                       id="password" 
                                       name="password"
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-2">Minimum 8 caractères avec lettres et chiffres</p>
                            </div>

                            <!-- Email notice shown when a password is typed -->
                            <div id="email-notice" class="hidden bg-blue-50 border-l-4 border-blue-400 p-3 rounded-lg text-sm text-blue-700">
                                📧 Un email contenant le nouveau mot de passe sera automatiquement envoyé à l'employé.
                            </div>
                        </div>

                        <!-- Account Status -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Statut du compte</h3>
                            
                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                                    Statut du compte *
                                </label>
                                <select id="is_active" 
                                        name="is_active" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                                    <option value="1" {{ old('is_active', $employee->is_active) ? 'selected' : '' }}>Actif</option>
                                    <option value="0" {{ !old('is_active', $employee->is_active) ? 'selected' : '' }}>Inactif</option>
                                </select>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-[#FFC62A] mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-600">
                                            <strong>Actif:</strong> L'employé peut se connecter et utiliser toutes les fonctionnalités.
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <strong>Inactif:</strong> L'employé ne peut pas se connecter au système.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-wrap gap-4 pt-6 border-t">
                            <button type="submit"
                                    class="flex items-center gap-2 bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#008D94] transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Enregistrer les modifications
                            </button>
                            
                            <a href="{{ route('admin.employees.index') }}" 
                               class="flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                                Annuler
                            </a>
                            
                            <form method="POST" 
                                  action="{{ route('admin.employees.toggle', $employee) }}" 
                                  class="inline"
                                  onsubmit="return confirm('Voulez-vous vraiment {{ $employee->is_active ? 'désactiver' : 'activer' }} cet employé ?')">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold transition
                                               {{ $employee->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        @if($employee->is_active)
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        @else
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        @endif
                                    </svg>
                                    {{ $employee->is_active ? 'Désactiver le compte' : 'Activer le compte' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Employee Details -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-[#01B3BB] rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">
                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $employee->name }}</h3>
                    <p class="text-gray-600">Employé</p>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $employee->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $employee->is_active ? '● Actif' : '● Inactif' }}
                        </span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">ID</span>
                        <span class="font-medium">{{ $employee->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Email</span>
                        <span class="font-medium">{{ $employee->email }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Inscrit le</span>
                        <span class="font-medium">{{ $employee->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Dernière modification</span>
                        <span class="font-medium">{{ $employee->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Activity Log -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Activité récente</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3"></div>
                        <div>
                            <p class="text-sm text-gray-800">Compte modifié</p>
                            <p class="text-xs text-gray-500">Aujourd'hui à {{ now()->format('H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></div>
                        <div>
                            <p class="text-sm text-gray-800">Dernière connexion</p>
                            <p class="text-xs text-gray-500">Hier à 14:30</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const passwordInput = document.getElementById('password');
    const emailNotice   = document.getElementById('email-notice');

    passwordInput.addEventListener('input', function () {
        const val = this.value;

        // Show / hide the email notification banner
        emailNotice.classList.toggle('hidden', val.length === 0);

        if (val.length > 0 && val.length < 8) {
            this.classList.add('border-red-500');
            this.classList.remove('border-gray-300');
        } else {
            this.classList.remove('border-red-500');
            this.classList.add('border-gray-300');
        }
    });
</script>
@endsection