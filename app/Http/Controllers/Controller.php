<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Controller extends \Illuminate\Routing\Controller
{
   public function welcome(Request $request)
{
    $search         = $request->input('search');
    $selectedCategory = $request->input('categorie');
    $minPrice       = $request->input('min_price');
    $maxPrice       = $request->input('max_price');

    $query = Livre::query()
        ->where('visible', true)
        ->with('categories');

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('titre',   'like', "%{$search}%")
              ->orWhere('auteur',  'like', "%{$search}%")
              ->orWhere('editeur', 'like', "%{$search}%");
        });
    }

    if ($selectedCategory) {
        $query->whereHas('categories', function($q) use ($selectedCategory) {
            $q->where('categories.id_categ', $selectedCategory);
        });
    }

    if ($minPrice !== null && is_numeric($minPrice)) {
        $query->where('prix', '>=', $minPrice);
    }

    if ($maxPrice !== null && is_numeric($maxPrice)) {
        $query->where('prix', '<=', $maxPrice);
    }
// === NOUVEAUX FILTRES MULTIPLES ===
$selectedAuteurs = (array) $request->input('auteurs', []);
$selectedEditeurs = (array) $request->input('editeurs', []);
$selectedAnnees = (array) $request->input('annees', []);

if (!empty($selectedAuteurs)) {
    $query->whereIn('auteur', $selectedAuteurs);
}
if (!empty($selectedEditeurs)) {
    $query->whereIn('editeur', $selectedEditeurs);
}
if (!empty($selectedAnnees)) {
    $query->whereIn(DB::raw('YEAR(annee_publication)'), $selectedAnnees);
}
    // Pagination : 8 livres par page
    $livres = $query->orderBy('titre')->paginate(8);

    // Garder les favoris (wishlist) si connecté
    if (Auth::check()) {
        $wishlistBookIds = Wishlist::where('user_id', Auth::id())
            ->pluck('livre_id')
            ->toArray();

        foreach ($livres as $livre) {
            $livre->is_in_wishlist = in_array($livre->id_livre, $wishlistBookIds);
        }
    }

    $categories = Categorie::orderBy('nom_categ')
        ->pluck('nom_categ', 'id_categ')
        ->toArray();

    $plagesPrix = $this->getPriceRangesWithCounts();
    
// Maisons d'édition
$editeurs = Livre::select('editeur', DB::raw('count(*) as count'))
    ->where('visible', true)
    ->whereNotNull('editeur')
    ->where('editeur', '!=', '')
    ->groupBy('editeur')
    ->orderBy('editeur')
    ->get()
    ->toArray();   // ← AJOUTÉ

// Auteurs
$auteurs = Livre::select('auteur', DB::raw('count(*) as count'))
    ->where('visible', true)
    ->whereNotNull('auteur')
    ->where('auteur', '!=', '')
    ->groupBy('auteur')
    ->orderBy('auteur')
    ->get()
    ->toArray();   // ← AJOUTÉ

// Années
$annees = Livre::select(DB::raw('YEAR(annee_publication) as annee'), DB::raw('count(*) as count'))
    ->where('visible', true)
    ->whereNotNull('annee_publication')
    ->groupBy(DB::raw('YEAR(annee_publication)'))
    ->orderByDesc('annee')
    ->get()
    ->toArray();

    $bestSellers = Livre::query()
        ->where('visible', true)
        ->withSum('commandes as total_vendu', 'commande_livre.quantite')
        ->orderByDesc('total_vendu')
        ->orderBy('titre')
        ->take(3)
        ->get();
    return view('welcome', compact(
        'livres',
        'categories',
        'plagesPrix',
        'editeurs',
          'auteurs',
          'annees',
          'bestSellers'
    ));
}
    private function calculatePriceRanges()
    {
        $minPrice = Livre::where('visible', true)->where('stock', '>', 0)->min('prix') ?? 0;
        $maxPrice = Livre::where('visible', true)->where('stock', '>', 0)->max('prix') ?? 100;
        $ranges = [];
        $step = max(1, ceil(($maxPrice - $minPrice) / 4));
        
        $rangeDefinitions = [
            ['min' => 0, 'max' => 5, 'label' => '0 - 5 dt'],
            ['min' => 5, 'max' => 10, 'label' => '5 - 10 dt'],
            ['min' => 10, 'max' => 20, 'label' => '10 - 20 dt'],
            ['min' => 20, 'max' => 30, 'label' => '20 - 30 dt'],
            ['min' => 30, 'max' => 50, 'label' => '30 - 50 dt'],
            ['min' => 50, 'max' => 1000, 'label' => '50 dt et plus'],
        ];
        
        foreach ($rangeDefinitions as $range) {
            $count = Livre::whereBetween('prix', [$range['min'], $range['max']])
                          ->where('visible', true)
                          ->where('stock', '>', 0)
                          ->count();
            
            if ($count > 0) {
                $ranges[] = [
                    'min' => $range['min'],
                    'max' => $range['max'],
                    'label' => $range['label'],
                    'count' => $count
                ];
            }
        }
        
        return $ranges;
    }

    public function show($id)
    {
        $livre = Livre::with('categories')
                      ->where('visible', true)
                      ->findOrFail($id);
        
        if (Auth::check()) {
            $isInWishlist = Wishlist::where('user_id', Auth::id())
                ->where('livre_id', $id)
                ->exists();
            
            $livre->is_in_wishlist = $isInWishlist;
        }
        
        $relatedBooks = Livre::whereHas('categories', function($q) use ($livre) {
            $q->whereIn('categories.id_categ', $livre->categories->pluck('id_categ'));
        })
        ->where('id_livre', '!=', $id)
        ->where('visible', true)
        ->where('stock', '>', 0)
        ->limit(4)
        ->get();
        
        if (Auth::check()) {
            $wishlistBookIds = Wishlist::where('user_id', Auth::id())
                ->pluck('livre_id')
                ->toArray();
            
            foreach ($relatedBooks as $book) {
                $book->is_in_wishlist = in_array($book->id_livre, $wishlistBookIds);
            }
        }
        
        return view('books.show', compact('livre', 'relatedBooks'));
    }

    public function index()
    {
        $livres = Livre::where('visible', true)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        $categories = Categorie::all();
        
        return view('books.index', compact('livres', 'categories'));
    }

    public function byCategory($category)
    {
        $categorie = Categorie::where('nom_categ', $category)->firstOrFail();
        
        $livres = $categorie->livres()
            ->where('visible', true)
            ->where('stock', '>', 0)
            ->paginate(12);
            
        $categories = Categorie::all();
        
        return view('books.category', compact('livres', 'categorie', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $livres = Livre::where('visible', true)
            ->where('stock', '>', 0)
            ->where(function($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%")
                  ->orWhere('auteur', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(12);
            
        $categories = Categorie::all();
        
        return view('books.search', compact('livres', 'query', 'categories'));
    }
    private function getPriceRangesWithCounts()
{
    $ranges = [
        ['min' => 0,   'max' => 5,    'label' => '0 – 5 dt'],
        ['min' => 5,   'max' => 10,   'label' => '5 – 10 dt'],
        ['min' => 10,  'max' => 20,   'label' => '10 – 20 dt'],
        ['min' => 20,  'max' => 30,   'label' => '20 – 30 dt'],
        ['min' => 30,  'max' => 50,   'label' => '30 – 50 dt'],
        ['min' => 50,  'max' => 9999, 'label' => '50 dt et plus'],
    ];

    $result = [];

    foreach ($ranges as $range) {
        $count = Livre::where('visible', true)
            ->where('stock', '>', 0)
            ->whereBetween('prix', [$range['min'], $range['max']])
            ->count();

        if ($count > 0) {
            $result[] = [
                'min'   => $range['min'],
                'max'   => $range['max'],
                'label' => $range['label'],
                'count' => $count,
            ];
        }
    }

    return $result;
}
}
