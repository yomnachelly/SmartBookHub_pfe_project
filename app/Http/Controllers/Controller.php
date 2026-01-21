<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;

class Controller extends \Illuminate\Routing\Controller
{
    public function welcome(Request $request)
    {
        $search = $request->input('search');
        $selectedCategory = $request->input('categorie');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        $query = Livre::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', '%' . $search . '%')
                  ->orWhere('auteur', 'like', '%' . $search . '%')
                  ->orWhere('editeur', 'like', '%' . $search . '%');
            });
        }
        
        if ($selectedCategory) {
            $query->whereHas('categories', function($q) use ($selectedCategory) {
                $q->where('categories.id_categ', $selectedCategory); // SPECIFIED TABLE
            });
        }
        
        if ($minPrice !== null) {
            $query->where('prix', '>=', $minPrice);
        }
        
        if ($maxPrice !== null) {
            $query->where('prix', '<=', $maxPrice);
        }
        
        $livres = $query->where('stock', '>', 0)
                        ->orderBy('titre')
                        ->get();
        
        $categories = Categorie::orderBy('nom_categ')
                              ->pluck('nom_categ', 'id_categ')
                              ->toArray();
        
        // calculate price ranges
        $priceRanges = $this->calculatePriceRanges();
        
        // make price range data ready for display
        $plagesPrix = [];
        foreach ($priceRanges as $range) {
            $count = Livre::whereBetween('prix', [$range['min'], $range['max']])
                          ->where('stock', '>', 0)
                          ->count();
            
            if ($count > 0) {
                $plagesPrix[] = [
                    'min' => $range['min'],
                    'max' => $range['max'],
                    'label' => $range['label'],
                    'count' => $count
                ];
            }
        }
        
        return view('welcome', compact('livres', 'categories', 'plagesPrix'));
    }
    
    private function calculatePriceRanges()
    {
        // price stats
        $minPrice = Livre::where('stock', '>', 0)->min('prix') ?? 0;
        $maxPrice = Livre::where('stock', '>', 0)->max('prix') ?? 100;
        $ranges = [];
        $step = max(1, ceil(($maxPrice - $minPrice) / 4));
        
        // fixed ranges
        $rangeDefinitions = [
            ['min' => 0, 'max' => 5, 'label' => '0 - 5 dt'],
            ['min' => 5, 'max' => 10, 'label' => '5 - 10 dt'],
            ['min' => 10, 'max' => 20, 'label' => '10 - 20 dt'],
            ['min' => 20, 'max' => 30, 'label' => '20 - 30 dt'],
            ['min' => 30, 'max' => 50, 'label' => '30 - 50 dt'],
            ['min' => 50, 'max' => 1000, 'label' => '50 dt et plus'],
        ];
        
        // filter ranges
        foreach ($rangeDefinitions as $range) {
            $count = Livre::whereBetween('prix', [$range['min'], $range['max']])
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
}