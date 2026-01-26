@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Mes Favoris
                </h1>
                <p class="text-white/80 mt-2">
                    {{ $wishlistCount }} livres sauvegardés
                </p>
            </div>
            <div>
                @if($wishlistCount > 0)
                <form method="POST" action="{{ route('client.wishlist.clear') }}" class="inline" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir vider toute votre liste de favoris ?');">
                    @csrf
                    @method('POST')
                    <button type="submit" 
                            class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-xl font-medium transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Vider la liste
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
    @endif

    @if(session('info'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
        {{ session('info') }}
    </div>
    @endif

    <!-- Wishlist Content -->
    @if($wishlistCount > 0)
    <div class="mb-6 flex justify-between items-center">
        <div class="text-gray-600">
            <span class="font-medium">{{ $wishlistCount }}</span> livres dans vos favoris
        </div>
        <div>
            <a href="{{ route('welcome') }}" class="text-[#01B3BB] hover:text-[#FFC62A] font-medium transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Continuer vos achats
            </a>
        </div>
    </div>

    <!-- Wishlist Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($wishlistItems as $wishlistItem)
        @php
            $livre = $wishlistItem->livre;
        @endphp
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <!-- Book Image -->
            <div class="relative">
                @if($livre->image && file_exists(storage_path('app/public/' . $livre->image)))
                    <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-56 object-cover">
                @else
                    <div class="w-full h-56 bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                @endif
                
                <!-- Remove from wishlist button -->
                <form method="POST" action="{{ route('client.wishlist.remove', $livre->id_livre) }}" class="absolute top-4 right-4">
                    @csrf
                    @method('POST')
                    <button type="submit" 
                            class="bg-white p-2 rounded-full shadow-lg hover:bg-red-50 transition"
                            onclick="return confirm('Retirer ce livre des favoris ?');">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </form>
            </div>
            
            <!-- Book Details -->
            <div class="p-4">
                <a href="{{ route('book.show', $livre->id_livre) }}" class="block mb-3">
                    <h4 class="font-bold text-[#1E1E1E] mb-2 truncate hover:text-[#01B3BB] transition">{{ $livre->titre }}</h4>
                </a>
                <p class="text-[#FFC62A] font-bold text-lg mb-1">{{ number_format($livre->prix, 3) }} dt</p>
                <p class="text-gray-600 text-sm mb-3">{{ $livre->auteur }}</p>
                
                <!-- Categories -->
                <div class="mb-3">
                    @if($livre->categories && $livre->categories->count() > 0)
                        @foreach($livre->categories->take(2) as $categorie)
                            <span class="inline-block text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded-full mr-1">
                                {{ $categorie->nom_categ }}
                            </span>
                        @endforeach
                    @endif
                </div>
                
                <!-- Actions -->
                <div class="flex justify-between items-center mt-4">
                    <!-- Stock Status -->
                    @if($livre->stock > 0)
                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800">
                            En stock ({{ $livre->stock }})
                        </span>
                    @else
                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800">
                            Rupture
                        </span>
                    @endif
                    
                    <!-- Add to Cart Button -->
                    @if($livre->stock > 0)
                    <form method="POST" action="{{ route('panier.ajouter', $livre->id_livre) }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-[#FFC62A] text-[#1E1E1E] px-4 py-2 rounded-lg font-semibold hover:bg-[#FFD666] transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z"/>
                            </svg>
                            Ajouter
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <!-- empty Wishlist -->
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
        <div class="max-w-md mx-auto">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">Votre liste de favoris est vide</h3>
            <p class="text-gray-500 mb-8">
                Ajoutez des livres à vos favoris pour les retrouver facilement plus tard.
                Vous pourrez les ajouter au panier directement depuis cette page.
            </p>
            <a href="{{ route('welcome') }}" 
               class="inline-flex items-center justify-center bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                Explorer la boutique
            </a>
        </div>
    </div>
    @endif
</div>
@endsection