@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Mon Panier
                </h1>
                <p class="text-white/80 mt-2">
                    @auth
                        Votre panier personnel
                    @else
                        Votre panier de visiteur
                    @endauth
                </p>
                <div class="flex items-center mt-4 gap-2">
                    @if(!$panierVide)
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                        {{ $items->sum('quantite') }} articles
                    </span>
                    <span class="text-white/60 text-sm">•</span>
                    @endif
                    <span class="text-white/80 text-sm">
                        @if(!$panierVide)
                            {{ $items->count() }} livres différents
                        @else
                            Panier vide
                        @endif
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('welcome') }}" 
                   class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Continuer mes achats
                </a>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
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

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    @if(!$panierVide)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Liste des articles -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4">
                    <h3 class="text-lg font-bold text-[#1E1E1E]">Articles dans le panier</h3>
                </div>
                
                <div class="p-6">
                    @foreach($items as $item)
                    <div class="border-b border-gray-100 py-6 last:border-0">
                        <div class="flex gap-4">
                            <!-- Image du livre -->
                            <div class="w-24 h-24 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                @if($item->image && Storage::exists($item->image))
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->titre }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                <svg class="w-10 h-10 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                                @endif
                            </div>
                            
                            <!-- Détails du livre -->
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-bold text-lg text-[#1E1E1E]">{{ $item->titre }}</h4>
                                        <p class="text-gray-500 text-sm mt-1">{{ $item->auteur }}</p>
                                        <p class="text-[#01B3BB] font-bold mt-2">
                                            {{ number_format($item->prix_unitaire ?? $item->prix, 3) }} dt
                                        </p>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex flex-col items-end gap-2">
                                        <form method="POST" action="{{ route('panier.retirer', $item->id_livre) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                        
                                        <!-- Gestion de la quantité -->
                                        <form method="POST" action="{{ route('panier.maj-quantite', $item->id_livre) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" onclick="decrementQuantity(this, {{ $item->id_livre }})" class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </button>
                                            <input type="number" name="quantite" value="{{ $item->quantite }}" min="1" 
                                                   max="{{ $item->stock }}" 
                                                   class="w-16 text-center border rounded py-1" 
                                                   onchange="this.form.submit()">
                                            <button type="button" onclick="incrementQuantity(this, {{ $item->id_livre }})" class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Stock et disponibilité -->
                                <div class="mt-2">
                                    @if($item->stock > 0)
                                        @if($item->stock >= $item->quantite)
                                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800">
                                                En stock ({{ $item->stock }} disponibles)
                                            </span>
                                        @else
                                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">
                                                Stock limité ({{ $item->stock }} disponibles)
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800">
                                            Rupture de stock
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Sous-total -->
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-gray-500">Sous-total :</span>
                                    <span class="font-bold text-lg">
                                        {{ number_format($item->sous_total, 3) }} dt
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Bouton vider panier -->
                    <div class="mt-6">
                        <form method="POST" action="{{ route('panier.vider') }}" onsubmit="return confirm('Vider tout le panier?')">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Vider le panier
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Récapitulatif et paiement -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                <h3 class="text-lg font-bold text-[#1E1E1E] mb-6">Récapitulatif</h3>
                
                <div class="space-y-4">
                    <!-- Total articles -->
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total articles :</span>
                        <span class="font-medium">{{ $items->sum('quantite') }}</span>
                    </div>
                    
                    <!-- Livres différents -->
                    <div class="flex justify-between">
                        <span class="text-gray-600">Livres différents :</span>
                        <span class="font-medium">{{ $items->count() }}</span>
                    </div>
                    
                    <!-- Sous-total -->
                    <div class="flex justify-between border-b pb-4">
                        <span class="text-gray-600">Sous-total :</span>
                        <span class="font-medium">{{ number_format($total, 3) }} dt</span>
                    </div>
                    
                    <!-- Total -->
                    <div class="flex justify-between text-lg font-bold mt-4 pt-4 border-t">
                        <span>Total à payer :</span>
                        <span class="text-[#01B3BB]">{{ number_format($total, 3) }} dt</span>
                    </div>
                    
                    <!-- Bouton passer au paiement -->
                    <div class="mt-8">
                        <div class="mb-4">
                            <h4 class="font-bold text-[#1E1E1E] mb-2">Prêt à commander ?</h4>
                            <p class="text-gray-600 text-sm">
                                Complétez vos informations pour finaliser la commande.
                            </p>
                        </div>
                        
                        <!-- Vérification du stock avant de continuer -->
                        @php
                            $stockProbleme = false;
                            $problemes = [];
                            foreach($items as $item) {
                                if ($item->stock < $item->quantite) {
                                    $stockProbleme = true;
                                    $problemes[] = "'{$item->titre}' : seulement {$item->stock} disponibles";
                                }
                            }
                        @endphp
                        
                        @if($stockProbleme)
                            <div class="mb-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium text-yellow-800">Attention au stock</span>
                                </div>
                                <ul class="mt-2 text-yellow-700 text-sm">
                                    @foreach($problemes as $probleme)
                                        <li class="mb-1">• {{ $probleme }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @if($stockProbleme)
                            <button type="button" disabled
                                    class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-medium cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                </svg>
                                Ajustez les quantités avant de continuer
                            </button>
                        @else
                            <a href="{{ route('panier.formulaire') }}" 
                               class="w-full bg-green-500 text-white py-3 rounded-lg font-medium hover:bg-green-600 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                valider votre commande
                            </a>
                        @endif
                    </div>
                    
                    <!-- Sécurité -->
                    <div class="mt-4 text-center text-sm text-gray-500">
                        <div class="flex items-center justify-center gap-2">
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
    @else
    <!-- Panier vide -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-12 text-center">
            <div class="w-32 h-32 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-20 h-20 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-4">Votre panier est vide</h3>
            <p class="text-gray-500 mb-8">Ajoutez des livres à votre panier pour commencer vos achats</p>
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 bg-[#01B3BB] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#008D94] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1-5H8.4M7 13L5.5 6H19M7 13l-2 5m2-5h12m-4 0v5"/>
                </svg>
                Découvrir nos livres
            </a>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function incrementQuantity(button, livreId) {
    const form = button.closest('form');
    const input = form.querySelector('input[name="quantite"]');
    const max = parseInt(input.getAttribute('max'));
    
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
        form.submit();
    } else {
        alert('Quantité maximale atteinte (stock disponible: ' + max + ')');
    }
}

function decrementQuantity(button, livreId) {
    const form = button.closest('form');
    const input = form.querySelector('input[name="quantite"]');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        form.submit();
    }
}

// Initialiser les tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggers = document.querySelectorAll('[data-tooltip]');
    tooltipTriggers.forEach(trigger => {
        trigger.addEventListener('mouseenter', function() {
            const tooltip = this.querySelector('.tooltip');
            if (tooltip) {
                tooltip.classList.remove('hidden');
            }
        });
        
        trigger.addEventListener('mouseleave', function() {
            const tooltip = this.querySelector('.tooltip');
            if (tooltip) {
                tooltip.classList.add('hidden');
            }
        });
    });
    
    // Afficher une alerte si le panier a des problèmes de stock
    @if($stockProbleme ?? false)
    const stockAlert = document.createElement('div');
    stockAlert.className = 'fixed bottom-4 right-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded shadow-lg z-50';
    stockAlert.innerHTML = `
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <strong class="font-bold">Attention !</strong>
                <span class="block sm:inline">Certains articles ont un stock limité.</span>
            </div>
            <button type="button" class="ml-auto text-yellow-700" onclick="this.parentElement.parentElement.remove()">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    `;
    document.body.appendChild(stockAlert);
    
    // Auto-remove après 10 secondes
    setTimeout(() => {
        if (stockAlert.parentElement) {
            stockAlert.remove();
        }
    }, 10000);
    @endif
});
</script>
@endsection

@section('styles')
<style>
.transition {
    transition: all 0.3s ease;
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
.sticky {
    position: -webkit-sticky;
    position: sticky;
}
</style>
@endsection