@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Ajouter un Nouveau Livre
                    </h1>
                    <p class="text-white/80 mt-2">
                        Remplissez les informations du livre
                    </p>
                </div>
                <a href="{{ route('admin.books.index') }}" 
                   class="bg-white text-[#01B3BB] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition">
                    ← Retour aux livres
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre du livre *
                            </label>
                            <input type="text" 
                                   id="titre"
                                   name="titre"
                                   value="{{ old('titre') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent @error('titre') border-red-500 @enderror"
                                   required>
                            @error('titre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="auteur" class="block text-sm font-medium text-gray-700 mb-2">
                                Auteur *
                            </label>
                            <input type="text" 
                                   id="auteur"
                                   name="auteur"
                                   value="{{ old('auteur') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent @error('auteur') border-red-500 @enderror"
                                   required>
                            @error('auteur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="editeur" class="block text-sm font-medium text-gray-700 mb-2">
                                Éditeur
                            </label>
                            <input type="text" 
                                   id="editeur"
                                   name="editeur"
                                   value="{{ old('editeur') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                        </div>

                        <div>
                            <label for="annee_publication" class="block text-sm font-medium text-gray-700 mb-2">
                                Année de publication
                            </label>
                            <input type="date" 
                                   id="annee_publication"
                                   name="annee_publication"
                                   value="{{ old('annee_publication') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                        </div>

                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                                Prix (dt) *
                            </label>
                            <input type="number" 
                                   id="prix"
                                   name="prix"
                                   value="{{ old('prix') }}"
                                   step="0.001"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent @error('prix') border-red-500 @enderror"
                                   required>
                            @error('prix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                Quantité en stock *
                            </label>
                            <input type="number" 
                                   id="stock"
                                   name="stock"
                                   value="{{ old('stock', 0) }}"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent @error('stock') border-red-500 @enderror"
                                   required>
                            @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{ open: false, selected: [] }" class="relative w-64">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Catégories
    </label>
    <!-- Bouton pour ouvrir la liste -->
    <button @click="open = !open" 
            type="button"
            class="w-full bg-white border border-gray-300 rounded-xl px-3 py-2 text-left focus:outline-none focus:ring-2 focus:ring-[#01B3BB]">
        <span x-text="selected.length ? selected.map(id => categories.find(c => c.id_categ == id).nom_categ).join(', ') : 'Sélectionner une catégorie'"></span>
    </button>

    <!-- Liste déroulante -->
    <div x-show="open" @click.away="open = false"
         class="absolute mt-1 w-full bg-white border border-gray-300 rounded-xl max-h-48 overflow-y-auto z-10">
        @foreach($categories as $category)
        <label class="flex items-center px-3 py-2 cursor-pointer hover:bg-gray-100">
            <input type="checkbox"
                   value="{{ $category->id_categ }}"
                   x-model="selected"
                   class="rounded border-gray-300 text-[#01B3BB] mr-2">
            <span>{{ $category->nom_categ }}</span>
        </label>
        @endforeach
    </div>

    <!-- Champs caché pour le formulaire -->
    <template x-for="id in selected" :key="id">
        <input type="hidden" name="categorie_ids[]" :value="id">
    </template>

    @error('categorie_ids')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<script>
    // Pour afficher les noms dans le bouton
    const categories = @json($categories);
</script>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Image du livre
                            </label>
                            <input type="file" 
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">
                            <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, GIF (max: 2MB)</p>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="hidden" name="visible" value="0">
                                <input type="checkbox" 
                                    name="visible" 
                                    value="1"
                                    {{ old('visible', '1') == '1' ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-[#01B3BB] focus:ring-[#01B3BB] mr-3">
                                <span class="text-gray-700 font-medium">Visible aux clients</span>
                            </label>
                            <p class="mt-1 text-sm text-gray-500">Si désactivé, le livre ne sera pas visible par les clients</p>
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-8 mt-8 border-t border-gray-200">
                    <a href="{{ route('admin.books.index') }}" 
                       class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium text-center hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] text-white rounded-xl font-medium hover:opacity-90 transition">
                        Ajouter le livre
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <div class="flex">
                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-blue-700 text-sm">
                        <strong>Astuce:</strong> Les champs marqués d'un * sont obligatoires. 
                        Vous pouvez ajouter plusieurs catégories à un livre.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection