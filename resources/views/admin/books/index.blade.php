@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Gestion des Livres
                </h1>
                <p class="text-white/80 mt-2">
                    Gérez tous les livres de votre bibliothèque
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">{{ $livres->total() }} livres</span>
                    <span class="text-white/60 text-sm">•</span>
                    <span class="text-white/80 text-sm">{{ $livres->count() }} affichés</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex gap-3">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="bg-[#FFC62A] text-[#1E1E1E] px-4 py-2 rounded-xl font-medium hover:bg-[#FFD666] transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                        </svg>
                        Catégories
                    </a>
                    <a href="{{ route('admin.books.create') }}" 
                       class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Nouveau Livre
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
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

    <!-- Quick Stats -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Livres en stock</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $livres->sum('stock') }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Valeur totale</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        @php
                            $totalValue = $livres->sum(function($livre) { 
                                return $livre->prix * $livre->stock; 
                            });
                        @endphp
                        {{ number_format($totalValue, 3) }} dt
                    </h3>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">En rupture</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $livres->where('stock', 0)->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('admin.books.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" 
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Rechercher un livre par titre, auteur, éditeur..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                    <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            
            <div class="w-full md:w-48">
                <select name="categorie" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id_categ }}" {{ request('categorie') == $category->id_categ ? 'selected' : '' }}>
                        {{ $category->nom_categ }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-full md:w-48">
                <select name="stock" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                    <option value="">Tous les stocks</option>
                    <option value="in_stock" {{ request('stock') == 'in_stock' ? 'selected' : '' }}>En stock</option>
                    <option value="out_of_stock" {{ request('stock') == 'out_of_stock' ? 'selected' : '' }}>Rupture</option>
                </select>
            </div>
            
            <button type="submit" class="px-6 py-3 bg-[#01B3BB] text-white rounded-xl font-medium hover:bg-[#008D94] transition">
                Filtrer
            </button>
            
            @if(request()->hasAny(['search', 'categorie', 'stock']))
            <a href="{{ route('admin.books.index') }}" 
               class="px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Réinitialiser
            </a>
            @endif
        </form>
        
        @if(request()->hasAny(['search', 'categorie', 'stock']))
        <div class="mt-4 text-sm text-gray-600">
            <div class="flex flex-wrap gap-2">
                @if(request('search'))
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                    Recherche: "{{ request('search') }}"
                </span>
                @endif
                @if(request('categorie'))
                @php
                    $selectedCategory = $categories->where('id_categ', request('categorie'))->first();
                @endphp
                @if($selectedCategory)
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">
                    Catégorie: {{ $selectedCategory->nom_categ }}
                </span>
                @endif
                @endif
                @if(request('stock') == 'in_stock')
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">
                    En stock seulement
                </span>
                @endif
                @if(request('stock') == 'out_of_stock')
                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full">
                    Rupture seulement
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Books Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-[#01B3BB] text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold">Liste des Livres</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm">{{ $livres->firstItem() }}-{{ $livres->lastItem() }} sur {{ $livres->total() }}</span>
            </div>
        </div>
        
        <div class="p-6">
            @if($livres->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Livre</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Auteur</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Prix</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Stock</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Catégories</th>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($livres as $livre)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-[#01B3BB]/10 rounded-lg flex items-center justify-center mr-3">
                                        @if($livre->image)
                                        <img src="{{ Storage::url($livre->image) }}" alt="{{ $livre->titre }}" class="w-10 h-10 object-cover rounded-lg">
                                        @else
                                        <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                        </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-medium block">{{ Str::limit($livre->titre, 40) }}</span>
                                        <span class="text-sm text-gray-500">{{ $livre->editeur }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">{{ $livre->auteur }}</td>
                            <td class="py-4 px-4 font-semibold">{{ number_format($livre->prix, 3) }} dt</td>
                            <td class="py-4 px-4">
                                @if($livre->stock > 0)
                                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800">
                                    {{ $livre->stock }} unités
                                </span>
                                @else
                                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-red-100 text-red-800">
                                    Rupture
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($livre->categories as $categorie)
                                    <span class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded-full">
                                        {{ $categorie->nom_categ }}
                                    </span>
                                    @empty
                                    <span class="text-xs text-gray-500">Aucune catégorie</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.books.edit', $livre) }}" 
                                       class="p-2 hover:bg-gray-100 rounded transition" title="Modifier">
                                        <svg class="w-4 h-4 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.books.toggle-stock', $livre) }}" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="p-2 hover:bg-gray-100 rounded transition" 
                                                title="{{ $livre->stock > 0 ? 'Mettre en rupture' : 'Réapprovisionner' }}">
                                            @if($livre->stock > 0)
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            @else
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                            </svg>
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('admin.books.destroy', $livre) }}" 
                                          class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 hover:bg-gray-100 rounded transition" 
                                                title="Supprimer">
                                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $livres->withQueryString()->links() }}
            </div>
            @else
            <div class="text-center py-12 text-gray-500">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <p class="text-lg mb-2">Aucun livre trouvé</p>
                @if(request()->hasAny(['search', 'categorie', 'stock']))
                <p class="text-sm mb-6">Essayez de modifier vos critères de recherche ou <a href="{{ route('admin.books.index') }}" class="text-[#01B3BB] hover:underline">réinitialiser les filtres</a></p>
                @else
                <p class="text-sm mb-6">Commencez par <a href="{{ route('admin.books.create') }}" class="text-[#01B3BB] hover:underline">ajouter un nouveau livre</a></p>
                @endif
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-[#FFC62A] hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Ajouter des catégories d'abord
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .transition {
        transition: all 0.3s ease;
    }
    
    /* Pagination styles */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin-top: 1.5rem;
    }
    
    .page-item {
        margin: 0 0.25rem;
    }
    
    .page-link {
        display: block;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        color: #4b5563;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .page-link:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
    }
    
    .page-item.active .page-link {
        background-color: #01B3BB;
        border-color: #01B3BB;
        color: white;
    }
    
    .page-item.disabled .page-link {
        color: #9ca3af;
        pointer-events: none;
        background-color: #f9fafb;
    }
</style>
@endsection