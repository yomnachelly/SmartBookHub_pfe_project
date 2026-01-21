@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-[#FFC62A] to-[#FFD666] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#1E1E1E]">
                    Gestion des Catégories
                </h1>
                <p class="text-[#1E1E1E]/80 mt-2">
                    Organisez vos livres par catégories
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">{{ $categories->total() }} catégories</span>
                    <span class="text-[#1E1E1E]/60 text-sm">•</span>
                    <span class="text-[#1E1E1E]/80 text-sm">{{ $categories->sum('livres_count') }} livres classés</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex gap-3">
                    <a href="{{ route('employee.books.index') }}" 
                       class="bg-[#01B3BB] text-white px-4 py-2 rounded-xl font-medium hover:bg-[#008D94] transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                        Retour aux Livres
                    </a>
                    <a href="{{ route('employee.categories.create') }}" 
                       class="bg-white text-[#FFC62A] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Nouvelle Catégorie
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- success/error messages -->
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
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- categories -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">{{ $category->nom_categ }}</h3>
                    <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm">
                        {{ $category->livres_count }} livres
                    </span>
                </div>
                @if($category->type_categ)
                <p class="text-white/80 text-sm mt-2">{{ $category->type_categ }}</p>
                @endif
            </div>
            
            <div class="p-6">
                @if($category->description_categ)
                <p class="text-gray-600 mb-4">{{ $category->description_categ }}</p>
                @else
                <p class="text-gray-400 italic mb-4">Aucune description</p>
                @endif
                
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Créée le {{ $category->created_at->format('d/m/Y') }}
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('employee.categories.edit', $category) }}" 
                           class="p-2 hover:bg-gray-100 rounded transition" title="Modifier">
                            <svg class="w-4 h-4 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </a>
                        
                        <form method="POST" action="{{ route('employee.categories.destroy', $category) }}" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
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
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- empty -->
    @if($categories->count() == 0)
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
        </svg>
        <p class="text-lg mb-2">Aucune catégorie trouvée</p>
        <p class="text-sm text-gray-500 mb-6">Les catégories vous aident à organiser vos livres</p>
        <a href="{{ route('employee.categories.create') }}" 
           class="inline-flex items-center bg-[#FFC62A] text-[#1E1E1E] px-6 py-3 rounded-xl font-medium hover:bg-[#FFD666] transition">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Créer votre première catégorie
        </a>
    </div>
    @endif

    @if($categories->hasPages())
    <div class="mt-8">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection