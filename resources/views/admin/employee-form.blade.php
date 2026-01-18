@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#1E1E1E]">
            @isset($employee)
                Modifier l'employé
            @else
                Ajouter un nouvel employé
            @endisset
        </h1>
        <p class="text-gray-600 mt-2">
            @isset($employee)
                Modifiez les informations de l'employé
            @else
                Remplissez le formulaire pour ajouter un nouvel employé
            @endisset
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-8">
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

        <form method="POST" 
              action="{{ isset($employee) ? route('admin.employees.update', $employee) : route('admin.employees.store') }}">
            @csrf
            @isset($employee)
                @method('PUT')
            @endisset

            <div class="space-y-6">
                <!-- name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom complet *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $employee->name ?? '') }}"
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent transition">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email *
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $employee->email ?? '') }}"
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent transition">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        @isset($employee)
                            Mot de passe (laisser vide pour ne pas modifier)
                        @else
                            Mot de passe *
                        @endisset
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           {{ !isset($employee) ? 'required' : '' }}
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent transition">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @isset($employee)
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Statut *
                    </label>
                    
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input type="radio" 
                                id="status_active" 
                                name="is_active" 
                                value="1" 
                                {{ old('is_active', $employee->is_active) == 1 ? 'checked' : '' }}
                                class="h-4 w-4 text-[#01B3BB] focus:ring-[#01B3BB] border-gray-300"
                                required>
                            <label for="status_active" class="ml-2 text-sm font-medium text-gray-700">
                                Actif
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="radio" 
                                id="status_inactive" 
                                name="is_active" 
                                value="0" 
                                {{ old('is_active', $employee->is_active) == 0 ? 'checked' : '' }}
                                class="h-4 w-4 text-[#01B3BB] focus:ring-[#01B3BB] border-gray-300"
                                required>
                            <label for="status_inactive" class="ml-2 text-sm font-medium text-gray-700">
                                Inactif
                            </label>
                        </div>
                    </div>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endisset
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#008D94] transition">
                    @isset($employee)
                        Enregistrer les modifications
                    @else
                        Ajouter l'employé
                    @endisset
                </button>
                
                <a href="{{ route('admin.dashboard') }}"
                   class="flex-1 bg-gray-100 text-gray-800 px-6 py-3 rounded-xl font-medium hover:bg-gray-200 transition text-center">
                    Annuler
                </a>
            </div>
        </form>

        @isset($employee)
        <div class="mt-8 pt-6 border-t border-gray-200">
            <form method="POST" 
                  action="{{ route('admin.employees.destroy', $employee) }}"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full bg-red-50 text-red-600 px-6 py-3 rounded-xl font-medium hover:bg-red-100 transition">
                    Supprimer cet employé
                </button>
            </form>
        </div>
        @endisset
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center text-[#01B3BB] hover:text-[#008D94] transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour au tableau de bord
        </a>
    </div>
</div>
@endsection