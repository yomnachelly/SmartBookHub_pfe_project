<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

}
