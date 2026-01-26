<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commande;
use App\Models\Wishlist;
use App\Models\Livre;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get();
        return view('dashboard.admin', compact('clients'));
    }

    public function toggle(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return back();
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        // all orders
        $commandes = Commande::where('user_id', $user->id)
            ->where('statut', '!=', 'en_panier')
            ->latest()
            ->take(5)
            ->get();

        // stats
        $totalCommandes = Commande::where('user_id', $user->id)
            ->where('statut', '!=', 'en_panier')
            ->count();

        $totalDépensé = Commande::where('user_id', $user->id)
            ->whereIn('statut', ['validee'])
            ->sum('total');

        // calculating this week's orders
        $thisWeekStart = now()->startOfWeek();
        $lastWeekStart = now()->subWeek()->startOfWeek();
        $lastWeekEnd = now()->subWeek()->endOfWeek();

        $thisWeekOrders = Commande::where('user_id', $user->id)
            ->where('statut', '!=', 'en_panier')
            ->where('created_at', '>=', $thisWeekStart)
            ->count();

        $lastWeekOrders = Commande::where('user_id', $user->id)
            ->where('statut', '!=', 'en_panier')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->count();

        $orderChange = $thisWeekOrders - $lastWeekOrders;

        $wishlistCount = Wishlist::where('user_id', $user->id)->count();

        return view('dashboard.client', compact(
            'commandes',
            'totalCommandes',
            'totalDépensé',
            'orderChange',
            'wishlistCount'
        ));
    }

    /**
     * display wishlist
     */
    public function wishlist()
    {
        $user = Auth::user();
        
        $wishlistItems = Wishlist::with(['livre' => function($query) {
            $query->with('categories');
        }])
        ->where('user_id', $user->id)
        ->latest()
        ->paginate(12);
        
        $wishlistCount = $wishlistItems->total();
        
        return view('wishlist.index', compact('wishlistItems', 'wishlistCount'));
    }

    /**
     * add a book to wishlist
     */
    public function addToWishlist(Request $request, $livreId)
    {
        $user = Auth::user();
        
        // checking if book exists
        $livre = Livre::find($livreId);
        if (!$livre) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Livre non trouvé'
                ], 404);
            }
            return back()->with('error', 'Livre non trouvé');
        }
        
        // checking if already in wishlist
        $exists = Wishlist::where('user_id', $user->id)
            ->where('livre_id', $livreId)
            ->exists();
            
        if ($exists) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce livre est déjà dans vos favoris'
                ]);
            }
            return back()->with('info', 'Ce livre est déjà dans vos favoris');
        }
        
        Wishlist::create([
            'user_id' => $user->id,
            'livre_id' => $livreId
        ]);
        
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Livre ajouté aux favoris',
                'wishlist_count' => $wishlistCount
            ]);
        }
        
        return back()->with('success', 'Livre ajouté aux favoris');
    }

    /**
     * remove a book from wishlist
     */
    public function removeFromWishlist(Request $request, $livreId)
    {
        $user = Auth::user();
        
        $deleted = Wishlist::where('user_id', $user->id)
            ->where('livre_id', $livreId)
            ->delete();
            
        if ($deleted) {
            $wishlistCount = Wishlist::where('user_id', $user->id)->count();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Livre retiré des favoris',
                    'wishlist_count' => $wishlistCount
                ]);
            }
            
            return back()->with('success', 'Livre retiré des favoris');
        }
        
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Livre non trouvé dans vos favoris'
            ]);
        }
        
        return back()->with('error', 'Livre non trouvé dans vos favoris');
    }

    /**
     * toggle wishlist status
     */
    public function toggleWishlist(Request $request, $livreId)
    {
        $user = Auth::user();
        
        $exists = Wishlist::where('user_id', $user->id)
            ->where('livre_id', $livreId)
            ->exists();
            
        if ($exists) {
            return $this->removeFromWishlist($request, $livreId);
        } else {
            return $this->addToWishlist($request, $livreId);
        }
    }

    /**
     * clear entire wishlist
     */
    public function clearWishlist(Request $request)
    {
        $user = Auth::user();
        
        $deleted = Wishlist::where('user_id', $user->id)->delete();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tous les favoris ont été supprimés',
                'wishlist_count' => 0
            ]);
        }
        
        return back()->with('success', 'Tous les favoris ont été supprimés');
    }
}