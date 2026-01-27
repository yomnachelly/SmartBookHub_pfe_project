<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request = null)
    {
        if (!$request) {
            $request = request();
        }
        
        $query = Livre::with('categories');
        
        // search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                ->orWhere('auteur', 'like', "%{$search}%")
                ->orWhere('editeur', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('categorie')) {
            $categorieId = $request->input('categorie');
            $query->whereHas('categories', function($q) use ($categorieId) {
                $q->where('categories.id_categ', $categorieId);
            });
        }
        
        if ($request->filled('stock')) {
            $stockFilter = $request->input('stock');
            if ($stockFilter === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($stockFilter === 'out_of_stock') {
                $query->where('stock', 0);
            }
        }
        
        if ($request->filled('visibility')) {
            $visibilityFilter = $request->input('visibility');
            if ($visibilityFilter === 'visible') {
                $query->where('visible', true);
            } elseif ($visibilityFilter === 'hidden') {
                $query->where('visible', false);
            }
        }
        
        $livres = $query->latest()->paginate(10)->withQueryString();
        $categories = Categorie::all();
        
        return view('admin.books.index', compact('livres', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'nullable|string|max:255',
            'annee_publication' => 'nullable|date',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'categorie_ids' => 'array',
            'categorie_ids.*' => 'exists:categories,id_categ',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visible' => 'nullable|in:0,1'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('livres', 'public');
        }

        $validated['visible'] = $request->input('visible', '0') === '1';

        $livre = Livre::create($validated);

        if ($request->has('categorie_ids')) {
            $livre->categories()->sync($request->categorie_ids);
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre ajouté avec succès!');
    }

    public function edit(Livre $livre)
    {
        $categories = Categorie::all();
        $livre->load('categories');
        return view('admin.books.edit', compact('livre', 'categories'));
    }

    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'nullable|string|max:255',
            'annee_publication' => 'nullable|date',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'categorie_ids' => 'array',
            'categorie_ids.*' => 'exists:categories,id_categ',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visible' => 'nullable|in:0,1'
        ]);

        if ($request->hasFile('image')) {
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            $validated['image'] = $request->file('image')->store('livres', 'public');
        }

        $validated['visible'] = $request->input('visible', '0') === '1';

        $livre->update($validated);

        if ($request->has('categorie_ids')) {
            $livre->categories()->sync($request->categorie_ids);
        } else {
            $livre->categories()->detach();
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre modifié avec succès!');
    }

    public function destroy(Livre $livre)
    {
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }
        
        $livre->categories()->detach();
        $livre->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre supprimé avec succès!');
    }

    public function toggleStock(Livre $livre)
    {
        $livre->update([
            'stock' => $livre->stock > 0 ? 0 : 100
        ]);

        return back()->with('success', 'Stock mis à jour avec succès!');
    }

    public function toggleVisibility(Livre $livre)
    {
        $livre->update([
            'visible' => !$livre->visible
        ]);

        return back()->with('success', 'Visibilité mise à jour avec succès!');
    }
}