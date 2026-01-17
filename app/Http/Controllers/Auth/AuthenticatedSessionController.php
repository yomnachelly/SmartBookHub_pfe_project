<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

     // 🔒 CLIENT VERROUILLÉ → BLOQUER ICI
    if (Auth::user()->role === 'client' && Auth::user()->is_active == 0) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Votre compte est verrouillé !',
        ]);
    }

    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if (Auth::user()->isEmploye()) {
        return redirect()->route('employe.dashboard');
    }

    return redirect()->route('client.dashboard');
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
