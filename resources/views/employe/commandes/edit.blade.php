@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Modifier la commande #ORD-{{ str_pad($commande->id, 3, '0', STR_PAD_LEFT) }}
                    </h1>
                    <p class="text-white/80 mt-1">
                        Modifier les informations de la commande
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ Auth::user()->role === 'employe' ? route('employe.commandes.index') : route('admin.commandes.index') }}" 
                       class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition">
                        ← Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <form action="{{ Auth::user()->role === 'employe' ? route('employe.commandes.update', $commande->id) : route('admin.commandes.update', $commande->id) }}" 
                  method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 pb-2 border-b">Informations client</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nom_client" class="block text-sm font-medium text-gray-700 mb-1">
                                Nom du client *
                            </label>
                            <input type="text" 
                                   name="nom_client" 
                                   id="nom_client"
                                   value="{{ old('nom_client', $commande->nom_client) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                   required>
                            @error('nom_client')
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
                                   value="{{ old('email', $commande->email) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">
                                Téléphone *
                            </label>
                            <input type="text" 
                                   name="telephone" 
                                   id="telephone"
                                   value="{{ old('telephone', $commande->telephone) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                   required>
                            @error('telephone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="mode_paiement" class="block text-sm font-medium text-gray-700 mb-1">
                                Mode de paiement
                            </label>
                            <select name="mode_paiement" 
                                    id="mode_paiement"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                                <option value="">Sélectionner</option>
                                <option value="carte" {{ old('mode_paiement', $commande->mode_paiement) == 'carte' ? 'selected' : '' }}>Carte bancaire</option>
                                <option value="especes" {{ old('mode_paiement', $commande->mode_paiement) == 'especes' ? 'selected' : '' }}>Espèces</option>
                                <option value="virement" {{ old('mode_paiement', $commande->mode_paiement) == 'virement' ? 'selected' : '' }}>Virement bancaire</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">
                            Adresse de livraison *
                        </label>
                        <textarea name="adresse" 
                                  id="adresse"
                                  rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                  required>{{ old('adresse', $commande->adresse) }}</textarea>
                        @error('adresse')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Order Status -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 pb-2 border-b">Statut de la commande</h3>
                    
                    <div class="flex flex-wrap gap-3">
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="statut" 
                                   value="en_attente" 
                                   {{ old('statut', $commande->statut) == 'en_attente' ? 'checked' : '' }}
                                   class="text-[#01B3BB] focus:ring-[#01B3BB]">
                            <span class="ml-2 text-sm font-medium text-gray-700">En attente</span>
                        </label>
                        
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="statut" 
                                   value="validee" 
                                   {{ old('statut', $commande->statut) == 'validee' ? 'checked' : '' }}
                                   class="text-[#01B3BB] focus:ring-[#01B3BB]">
                            <span class="ml-2 text-sm font-medium text-gray-700">Validée</span>
                        </label>
                        
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="statut" 
                                   value="annulee" 
                                   {{ old('statut', $commande->statut) == 'annulee' ? 'checked' : '' }}
                                   class="text-[#01B3BB] focus:ring-[#01B3BB]">
                            <span class="ml-2 text-sm font-medium text-gray-700">Annulée</span>
                        </label>
                    </div>
                    @error('statut')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- order Items -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#1E1E1E] mb-4 pb-2 border-b">Articles de la commande</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Livre</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Prix unitaire</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Quantité</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($commande->livres as $livre)
                                @php
                                    $quantite = $livre->pivot->quantite;
                                    $prix = $livre->pivot->prix;
                                    $sousTotal = $quantite * $prix;
                                    $total += $sousTotal;
                                @endphp
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-lg mr-3">
                                                @if($livre->image)
                                                <img src="{{ asset('storage/' . $livre->image) }}" 
                                                     alt="{{ $livre->titre }}"
                                                     class="w-full h-full object-cover rounded-lg">
                                                @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $livre->titre }}</p>
                                                <p class="text-sm text-gray-500">{{ $livre->auteur }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <input type="number" 
                                               step="0.001"
                                               name="livres[{{ $livre->id_livre }}][prix]"
                                               value="{{ old('livres.' . $livre->id_livre . '.prix', $prix) }}"
                                               class="w-24 px-3 py-1 border border-gray-300 rounded text-center"
                                               min="0">
                                    </td>
                                    <td class="py-4 px-4">
                                        <input type="number" 
                                               name="livres[{{ $livre->id_livre }}][quantite]"
                                               value="{{ old('livres.' . $livre->id_livre . '.quantite', $quantite) }}"
                                               class="w-20 px-3 py-1 border border-gray-300 rounded text-center"
                                               min="1">
                                    </td>
                                    <td class="py-4 px-4 font-medium">
                                        {{ number_format($sousTotal, 3) }} dt
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="py-4 px-4 text-right font-medium">Total:</td>
                                    <td class="py-4 px-4 font-bold text-lg text-[#01B3BB]">
                                        {{ number_format($total, 3) }} dt
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-6 border-t">
                    <div class="text-sm text-gray-500">
                        Dernière modification: {{ $commande->updated_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ Auth::user()->role === 'employe' ? route('employe.commandes.index') : route('admin.commandes.index') }}" 
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