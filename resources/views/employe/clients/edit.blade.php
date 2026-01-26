@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                        <span class="text-[#01B3BB] text-lg font-bold">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">
                            Modifier le client
                        </h1>
                        <p class="text-white/80 mt-1">
                            {{ $client->name }} • ID: #CLT-{{ str_pad($client->id, 3, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('employe.clients.show', $client->id) }}" 
                       class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition">
                        ← Annuler
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <form action="{{ route('employe.clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 pb-2 border-b">Informations personnelles</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nom complet *
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name', $client->name) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                   required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email *
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email', $client->email) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Nouveau mot de passe (laisser vide pour ne pas changer)
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Minimum 8 caractères avec lettres, chiffres et symboles
                        </p>
                    </div>
                </div>
                
                <!-- status -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 pb-2 border-b">Statut du compte</h3>
                    
                    <div class="flex flex-wrap gap-6">
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $client->is_active) == 1 ? 'checked' : '' }}
                                   class="text-[#01B3BB] focus:ring-[#01B3BB]">
                            <div class="ml-3">
                                <span class="block font-medium text-gray-700">Actif</span>
                                <span class="text-sm text-gray-500">Le client peut se connecter et passer des commandes</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="is_active" 
                                   value="0" 
                                   {{ old('is_active', $client->is_active) == 0 ? 'checked' : '' }}
                                   class="text-[#01B3BB] focus:ring-[#01B3BB]">
                            <div class="ml-3">
                                <span class="block font-medium text-gray-700">Inactif</span>
                                <span class="text-sm text-gray-500">Le client ne peut pas se connecter</span>
                            </div>
                        </label>
                    </div>
                    @error('is_active')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between pt-6 border-t">
                    <div class="text-sm text-gray-500">
                        Dernière modification: {{ $client->updated_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('employe.clients.show', $client->id) }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-[#01B3BB] text-white rounded-lg hover:bg-[#0199A1] transition font-medium">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection