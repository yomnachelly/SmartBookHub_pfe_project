@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-[#FFC62A] to-[#FFD666] rounded-t-3xl p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#1E1E1E]">
                        Modifier le Livre
                    </h1>
                    <p class="text-[#1E1E1E]/80 mt-2">
                        {{ $livre->titre }}
                    </p>
                </div>
                <a href="{{ route('employee.books.index') }}" 
                   class="bg-white text-[#FFC62A] px-4 py-2 rounded-xl font-medium hover:bg-white/90 transition">
                    ← Retour aux livres
                </a>
            </div>
        </div>

        <!-- form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('employee.books.update', $livre) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- left col -->
                    <div class="space-y-6">
                        <!-- title -->
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre du livre *
                            </label>
                            <input type="text" 
                                   id="titre"
                                   name="titre"
                                   value="{{ old('titre', $livre->titre) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent @error('titre') border-red-500 @enderror"
                                   required>
                            @error('titre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- author -->
                        <div>
                            <label for="auteur" class="block text-sm font-medium text-gray-700 mb-2">
                                Auteur *
                            </label>
                            <input type="text" 
                                   id="auteur"
                                   name="auteur"
                                   value="{{ old('auteur', $livre->auteur) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent @error('auteur') border-red-500 @enderror"
                                   required>
                            @error('auteur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- publisher -->
                        <div>
                            <label for="editeur" class="block text-sm font-medium text-gray-700 mb-2">
                                Éditeur
                            </label>
                            <input type="text" 
                                   id="editeur"
                                   name="editeur"
                                   value="{{ old('editeur', $livre->editeur) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent">
                        </div>

                        <!-- publication year -->
                        <div>
                            <label for="annee_publication" class="block text-sm font-medium text-gray-700 mb-2">
                                Année de publication
                            </label>
                            <input type="date" 
                                   id="annee_publication"
                                   name="annee_publication"
                                   value="{{ old('annee_publication', $livre->annee_publication ? $livre->annee_publication->format('Y-m-d') : '') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent">
                        </div>

                        <!-- price -->
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                                Prix (dt) *
                            </label>
                            <input type="number" 
                                   id="prix"
                                   name="prix"
                                   value="{{ old('prix', $livre->prix) }}"
                                   step="0.001"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent @error('prix') border-red-500 @enderror"
                                   required>
                            @error('prix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- right col -->
                    <div class="space-y-6">
                        <!-- stock -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                Quantité en stock *
                            </label>
                            <input type="number" 
                                   id="stock"
                                   name="stock"
                                   value="{{ old('stock', $livre->stock) }}"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent @error('stock') border-red-500 @enderror"
                                   required>
                            @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- categories -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Catégories
                            </label>
                            <div class="space-y-2 max-h-48 overflow-y-auto p-3 border border-gray-300 rounded-xl">
                                @foreach($categories as $category)
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="categorie_ids[]" 
                                           value="{{ $category->id_categ }}"
                                           class="rounded border-gray-300 text-[#FFC62A] focus:ring-[#FFC62A] mr-3"
                                           {{ in_array($category->id_categ, old('categorie_ids', $livre->categories->pluck('id_categ')->toArray())) ? 'checked' : '' }}>
                                    <span class="text-gray-700">{{ $category->nom_categ }}</span>
                                </label>
                                @endforeach
                            </div>
                            @error('categorie_ids')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- img -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Image du livre
                            </label>
                            @if($livre->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $livre->image) }}" 
                                     alt="{{ $livre->titre }}" 
                                     class="w-32 h-32 object-cover rounded-lg mb-2">
                                <p class="text-sm text-gray-500">Image actuelle</p>
                            </div>
                            @endif
                            <input type="file" 
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent">
                            <p class="mt-1 text-sm text-gray-500">Laisser vide pour conserver l'image actuelle</p>
                        </div>

                        <!-- desc -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-transparent">{{ old('description', $livre->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- stats -->
                <div class="mt-8 p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations du livre</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Date d'ajout</p>
                            <p class="font-medium">{{ $livre->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Dernière modification</p>
                            <p class="font-medium">{{ $livre->updated_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Catégories assignées</p>
                            <p class="font-medium">{{ $livre->categories->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Statut</p>
                            <p class="font-medium {{ $livre->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $livre->stock > 0 ? 'En stock' : 'Rupture' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- btns -->
                <div class="flex gap-4 pt-8 mt-8 border-t border-gray-200">
                    <a href="{{ route('employee.books.index') }}" 
                       class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium text-center hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-[#FFC62A] to-[#FFD666] text-[#1E1E1E] rounded-xl font-medium hover:opacity-90 transition">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection