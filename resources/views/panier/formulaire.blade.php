@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- En-tête -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">Finaliser votre commande</h1>
                <p class="text-white/80 mt-2">Remplissez vos informations pour passer la commande</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('panier.index') }}" 
                   class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour au panier
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulaire -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4">
                    <h3 class="text-lg font-bold text-[#1E1E1E]">Informations personnelles</h3>
                </div>
                
                <form method="POST" action="{{ route('panier.valider-commande') }}" class="p-6">
                    @csrf
                    
                    <!-- Informations client -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-2" for="nom_client">Nom complet *</label>
                                <input type="text" id="nom_client" name="nom_client" 
                                       value="{{ old('nom_client', $userData['nom_client'] ?? '') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                       required>
                                @error('nom_client')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 mb-2" for="email">Email *</label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email', $userData['email'] ?? '') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                       required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-2" for="telephone">Téléphone *</label>
                                <input type="text" id="telephone" name="telephone"
                                       value="{{ old('telephone') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                       required>
                                @error('telephone')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 mb-2" for="mode_paiement">Mode de paiement *</label>
                                <select id="mode_paiement" name="mode_paiement"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                        required>
                                    <option value="">Choisir un mode de paiement</option>
                                    <option value="ligne" {{ old('mode_paiement') == 'ligne' ? 'selected' : '' }}>
                                        Paiement en ligne
                                    </option>
                                    <option value="sur_place" {{ old('mode_paiement') == 'sur_place' ? 'selected' : '' }}>
                                        Paiement à la livraison
                                    </option>
                                </select>
                                @error('mode_paiement')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="adresse">Adresse de livraison *</label>
                            <textarea id="adresse" name="adresse" rows="3"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                                   required>{{ old('adresse') }}</textarea>
                            @error('adresse')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Instructions pour le paiement -->
                        <div id="instructions-ligne" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-bold text-blue-800 mb-2">Instructions pour le paiement en ligne</h4>
                            <p class="text-blue-700 text-sm">
                                Après validation, vous serez redirigé vers notre plateforme de paiement sécurisée.
                                Votre commande sera traitée après confirmation du paiement.
                            </p>
                        </div>
                        
                        <div id="instructions-sur-place" class="hidden bg-green-50 border border-green-200 rounded-lg p-4">
                            <h4 class="font-bold text-green-800 mb-2">Instructions pour le paiement à la livraison</h4>
                            <p class="text-green-700 text-sm">
                                Vous paierez directement au livreur lors de la réception de votre commande.
                                Veuillez préparer le montant exact si possible.
                            </p>
                        </div>
                        
                        <!-- Conditions -->
                        <div class="mt-4">
                            <label class="flex items-start">
                                <input type="checkbox" name="terms" class="mt-1 mr-2" required>
                                <span class="text-sm text-gray-600">
                                    J'accepte les <a href="#" class="text-[#01B3BB] hover:underline">conditions générales de vente</a>
                                    et la <a href="#" class="text-[#01B3BB] hover:underline">politique de confidentialité</a>
                                </span>
                            </label>
                            @error('terms')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Boutons -->
                    <div class="mt-8 flex gap-4">
                        <button type="submit" 
                                class="flex-1 bg-green-500 text-white py-3 rounded-lg font-medium hover:bg-green-600 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Valider la commande
                        </button>
                        
                        <a href="{{ route('panier.index') }}" 
                           class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-medium hover:bg-gray-300 transition flex items-center justify-center">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Récapitulatif -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-6">Récapitulatif de commande</h3>
                
                <!-- Liste des articles -->
                <div class="space-y-3 mb-4">
                    @if(isset($items) && count($items) > 0)
                        @foreach($items as $item)
                            <div class="flex justify-between items-center border-b pb-2">
                                <div>
                                    <p class="font-medium text-sm">{{ $item->titre }}</p>
                                    <p class="text-gray-500 text-xs">
                                        {{ $item->quantite }} × {{ number_format($item->prix_unitaire ?? $item->prix, 3) }} dt
                                    </p>
                                </div>
                                <span class="font-bold">
                                    {{ number_format(($item->quantite * ($item->prix_unitaire ?? $item->prix)), 3) }} dt
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">Votre panier est vide</p>
                    @endif
                </div>
                
                <!-- Total -->
                <div class="border-t pt-4">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total :</span>
                        <span class="text-[#01B3BB]">
                            @php
                                $total = 0;
                                if(isset($items) && count($items) > 0) {
                                    foreach($items as $item) {
                                        $total += $item->quantite * ($item->prix_unitaire ?? $item->prix);
                                    }
                                }
                            @endphp
                            {{ number_format($total, 3) }} dt
                        </span>
                    </div>
                </div>
                
                <!-- Sécurité -->
                <div class="mt-6 text-center text-sm text-gray-500">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Paiement sécurisé
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modePaiementSelect = document.getElementById('mode_paiement');
    const instructionsLigne = document.getElementById('instructions-ligne');
    const instructionsSurPlace = document.getElementById('instructions-sur-place');
    
    function updateInstructions() {
        // Cacher toutes les instructions
        instructionsLigne.classList.add('hidden');
        instructionsSurPlace.classList.add('hidden');
        
        // Afficher les instructions correspondantes
        if (modePaiementSelect.value === 'ligne') {
            instructionsLigne.classList.remove('hidden');
        } else if (modePaiementSelect.value === 'sur_place') {
            instructionsSurPlace.classList.remove('hidden');
        }
    }
    
    // Écouter les changements
    modePaiementSelect.addEventListener('change', updateInstructions);
    
    // Initialiser au chargement
    updateInstructions();
});
</script>
@endsection