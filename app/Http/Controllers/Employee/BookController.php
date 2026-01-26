<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request = null)
    {
        // Handle case where request might be null
        if (!$request) {
            $request = request();
        }
        
        $query = Livre::with('categories');
        
        //search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhere('auteur', 'LIKE', "%{$search}%")
                  ->orWhere('editeur', 'LIKE', "%{$search}%")
                  ->orWhereHas('categories', function($q) use ($search) {
                      $q->where('nom_categ', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        //filtering by category
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id_categ', $request->category);
            });
        }
        
        //filtering by stock
        if ($request->has('stock') && $request->stock != '') {
            if ($request->stock == 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($request->stock == 'out_of_stock') {
                $query->where('stock', '=', 0);
            }
        }
        
        $livres = $query->latest()->paginate(10);
        $categories = Categorie::all();
        
        $livres->appends($request->all());
        
        return view('employee.books.index', compact('livres', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('employee.books.create', compact('categories'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('livres', 'public');
        }

        $livre = Livre::create($validated);

        if ($request->has('categorie_ids')) {
            $livre->categories()->sync($request->categorie_ids);
        }

        return redirect()->route('employee.books.index')
            ->with('success', 'Livre ajouté avec succès!');
    }

    public function edit(Livre $livre)
    {
        $categories = Categorie::all();
        $livre->load('categories');
        return view('employee.books.edit', compact('livre', 'categories'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            $validated['image'] = $request->file('image')->store('livres', 'public');
        }

        $livre->update($validated);

        if ($request->has('categorie_ids')) {
            $livre->categories()->sync($request->categorie_ids);
        } else {
            $livre->categories()->detach();
        }

        return redirect()->route('employee.books.index')
            ->with('success', 'Livre modifié avec succès!');
    }

    public function destroy(Livre $livre)
    {
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }
        
        $livre->categories()->detach();
        $livre->delete();

        return redirect()->route('employee.books.index')
            ->with('success', 'Livre supprimé avec succès!');
    }

    public function toggleStock(Livre $livre)
    {
        $livre->update([
            'stock' => $livre->stock > 0 ? 0 : 100
        ]);

        return back()->with('success', 'Stock mis à jour avec succès!');
    }
}