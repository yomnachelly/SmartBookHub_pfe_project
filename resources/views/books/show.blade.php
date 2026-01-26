@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ url('/') }}" class="inline-flex items-center text-[#01B3BB] hover:text-[#008D94] transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour aux livres
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/3 p-8">
                <div class="bg-gradient-to-br from-[#01B3BB]/10 to-[#4ECFD7]/10 rounded-xl p-6">
                    @if($livre->image && file_exists(storage_path('app/public/' . $livre->image)))
                        <img src="{{ asset('storage/' . $livre->image) }}" 
                             alt="{{ $livre->titre }}" 
                             class="w-full h-auto max-h-[400px] object-contain rounded-lg shadow-lg">
                    @else
                        <div class="w-full h-[400px] bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-lg flex items-center justify-center">
                            <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="mt-6 text-center">
                    @if($livre->stock > 0)
                        <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold">
                            ✅ En stock - {{ $livre->stock }} unités disponibles
                        </span>
                    @else
                        <span class="inline-block px-4 py-2 bg-red-100 text-red-800 rounded-full font-semibold">
                            ⚠️ Rupture de stock
                        </span>
                    @endif
                </div>
            </div>

            <div class="md:w-2/3 p-8">
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h1 class="text-3xl font-bold text-[#1E1E1E] mb-2">{{ $livre->titre }}</h1>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-lg">par <span class="font-semibold">{{ $livre->auteur }}</span></p>
                            @if($livre->editeur)
                                <p class="text-gray-500 text-sm mt-1">Éditeur: {{ $livre->editeur }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-[#FFC62A]">{{ number_format($livre->prix, 3) }} dt</p>
                            @if($livre->annee_publication)
                                <p class="text-gray-500 text-sm">Publié le {{ \Carbon\Carbon::parse($livre->annee_publication)->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                @if($livre->categories && $livre->categories->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Catégories</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($livre->categories as $categorie)
                        <span class="px-3 py-1 bg-[#01B3BB]/10 text-[#01B3BB] rounded-full text-sm font-medium">
                            {{ $categorie->nom_categ }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Description</h3>
                    <div class="prose max-w-none text-gray-600">
                        @if($livre->description)
                            {!! nl2br(e($livre->description)) !!}
                        @else
                            <p class="text-gray-400 italic">Aucune description disponible pour ce livre.</p>
                        @endif
                    </div>
                </div>

                <div class="flex gap-4">
                    @if($livre->stock > 0)
                    <form action="{{ route('panier.ajouter', $livre->id_livre) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-[#FFC62A] text-[#1E1E1E] px-6 py-4 rounded-xl font-bold hover:bg-[#FFD666] transition flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Ajouter au panier
                        </button>
                    </form>
                    @endif
                    
                    <button class="px-6 py-4 border-2 border-[#FFC62A] text-[#FFC62A] rounded-xl font-bold hover:bg-[#FFC62A]/10 transition flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        Ajouter aux favoris
                    </button>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Détails du livre</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Auteur</p>
                            <p class="font-medium">{{ $livre->auteur }}</p>
                        </div>
                        @if($livre->editeur)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Éditeur</p>
                            <p class="font-medium">{{ $livre->editeur }}</p>
                        </div>
                        @endif
                        @if($livre->annee_publication)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Date de publication</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($livre->annee_publication)->format('d/m/Y') }}</p>
                        </div>
                        @endif
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Prix</p>
                            <p class="font-medium text-[#FFC62A]">{{ number_format($livre->prix, 3) }} dt</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Stock disponible</p>
                            <p class="font-medium {{ $livre->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $livre->stock > 0 ? $livre->stock . ' unités' : 'Rupture' }}
                            </p>
                        </div>
                        @if($livre->categorie)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Catégorie principale</p>
                            <p class="font-medium">{{ $livre->categorie }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($relatedBooks) && $relatedBooks->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-[#1E1E1E] mb-6">Livres similaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedBooks as $relatedBook)
            <div class="book-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition relative group">
                <a href="{{ route('book.show', $relatedBook->id_livre) }}" class="absolute inset-0 z-10"></a>
                
                <div class="relative">
                    @if($relatedBook->image && file_exists(storage_path('app/public/' . $relatedBook->image)))
                        <img src="{{ asset('storage/' . $relatedBook->image) }}" alt="{{ $relatedBook->titre }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-[#1E1E1E] mb-2 truncate">{{ $relatedBook->titre }}</h4>
                    <p class="text-[#FFC62A] font-bold">{{ number_format($relatedBook->prix, 3) }} dt</p>
                    <p class="text-gray-600 text-sm">{{ $relatedBook->auteur }}</p>
                    <div class="mt-2">
                        @if($relatedBook->stock > 0)
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800">
                                En stock
                            </span>
                        @else
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800">
                                Rupture
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .book-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
    }
    
    .prose p {
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    .prose p:last-child {
        margin-bottom: 0;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.border-\\[\\#FFC62A\\]').addEventListener('click', function(e) {
            e.preventDefault();
            const svg = this.querySelector('svg');
            const title = "{{ $livre->titre }}";
            
            const isFilled = svg.getAttribute('fill') === 'currentColor';
            if (isFilled) {
                svg.setAttribute('fill', 'none');
                svg.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>';
                alert(`"${title}" retiré des favoris`);
            } else {
                svg.setAttribute('fill', 'currentColor');
                svg.innerHTML = '<path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>';
                alert(`"${title}" ajouté aux favoris!`);
            }
        });
    });
</script>
@endsection