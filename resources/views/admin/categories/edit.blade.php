@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Modifier Catégorie
                    </h1>
                    <p class="text-white/80 mt-2">
                        Modifier la catégorie: {{ $category->nom_categ }}
                    </p>
                </div>
                <a href="{{ route('admin.categories.index') }}" 
                   class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition">
                    ← Retour
                </a>
            </div>
        </div>

        <!-- form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- name -->
                    <div>
                        <label for="nom_categ" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la catégorie *
                        </label>
                        <input type="text" 
                               id="nom_categ"
                               name="nom_categ"
                               value="{{ old('nom_categ', $category->nom_categ) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent @error('nom_categ') border-red-500 @enderror"
                               required>
                        @error('nom_categ')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- type -->
                    <div>
                        <label for="type_categ" class="block text-sm font-medium text-gray-700 mb-2">
                            Type
                        </label>
                        <input type="text" 
                               id="type_categ"
                               name="type_categ"
                               value="{{ old('type_categ', $category->type_categ) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                               placeholder="Ex: Fiction, Non-fiction, Éducatif...">
                    </div>

                    <!-- desc -->
                    <div>
                        <label for="description_categ" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description_categ"
                                  name="description_categ"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">{{ old('description_categ', $category->description_categ) }}</textarea>
                    </div>

                    <!-- stats -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Livres dans cette catégorie</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $category->livres_count }}</p>
                            </div>
                            <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- btns -->
                    <div class="flex gap-4 pt-6">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium text-center hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] text-white rounded-xl font-medium hover:opacity-90 transition">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection