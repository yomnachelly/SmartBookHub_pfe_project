<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\PasswordChangedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $passwordChanged = false;
        
        if ($request->filled('current_password') && $request->filled('password')) {
            $passwordChanged = true;
            
            $user->password = Hash::make($request->password);
            
            \Log::info('Password changed for user: ' . $user->email);
        }
        
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        
        if ($request->filled('email') && $request->email !== $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }
        
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        
        if ($request->has('address')) {
            $user->address = $request->address;
        }

        $user->save();

        // email notification if password was changed
        if ($passwordChanged) {
            try {
                Mail::to($user->email)->send(new PasswordChangedNotification($user));
                \Log::info('Password change email sent successfully to: ' . $user->email);
                
                return Redirect::route('profile.edit')->with('status', 'password-updated');
            } catch (\Exception $e) {
                \Log::error('Failed to send password change email to ' . $user->email . ': ' . $e->getMessage());
                
                return Redirect::route('profile.edit')
                    ->with('status', 'password-updated')
                    ->with('warning', 'Mot de passe mis à jour mais l\'email de confirmation n\'a pas pu être envoyé.');
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}