<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('livres')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_categ' => 'required|string|max:255|unique:categories',
            'description_categ' => 'nullable|string',
            'type_categ' => 'nullable|string|max:100'
        ]);

        Categorie::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie ajoutée avec succès!');
    }

    public function edit(Categorie $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Categorie $category)
    {
        $validated = $request->validate([
            'nom_categ' => 'required|string|max:255|unique:categories,nom_categ,' . $category->id_categ . ',id_categ',
            'description_categ' => 'nullable|string',
            'type_categ' => 'nullable|string|max:100'
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès!');
    }

    public function destroy(Categorie $category)
    {
        // if category has books
        if ($category->livres()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des livres!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès!');
    }
}