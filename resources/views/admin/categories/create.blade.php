@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-r from-[#FFC62A] to-[#FFD666] rounded-t-3xl p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#1E1E1E]">
                        Nouvelle Catégorie
                    </h1>
                    <p class="text-[#1E1E1E]/80 mt-2">
                        Ajouter une nouvelle catégorie de livres
                    </p>
                </div>
                <a href="{{ route('admin.categories.index') }}" 
                   class="bg-white text-[#FFC62A] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition">
                    ← Retour
                </a>
            </div>
        </div>

        <!-- form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- name -->
                    <div>
                        <label for="nom_categ" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la catégorie *
                        </label>
                        <input type="text" 
                               id="nom_categ"
                               name="nom_categ"
                               value="{{ old('nom_categ') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent @error('nom_categ') border-red-500 @enderror"
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
                               value="{{ old('type_categ') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent"
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
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent">{{ old('description_categ') }}</textarea>
                    </div>

                    <!-- btns -->
                    <div class="flex gap-4 pt-6">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium text-center hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-[#FFC62A] to-[#FFD666] text-[#1E1E1E] rounded-xl font-medium hover:opacity-90 transition">
                            Créer la catégorie
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection