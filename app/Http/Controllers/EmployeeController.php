<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = User::where('role', 'employe')->get();
        $clients = User::where('role', 'client')->get();
        
        return view('dashboard.admin', compact('employees', 'clients'));
    }


    public function create()
    {
        return view('admin.employee-form');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employe',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Employé ajouté avec succès!');
    }


    public function edit(User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(403);
        }

        return view('admin.employee-form', compact('employee'));
    }


    public function update(Request $request, User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $employee->id],
            'is_active' => ['required', 'in:0,1'],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => (int)$request->is_active === 1,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => [Rules\Password::defaults()],
            ]);
            $updateData['password'] = Hash::make($request->password);
        }

        $employee->update($updateData);

        return redirect()->route('admin.dashboard')->with('success', 'Employé modifié avec succès!');
    }


    public function destroy(User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(403);
        }

        $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Employé supprimé avec succès!');
    }


    public function toggleActive(User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(403);
        }

        $employee->update([
            'is_active' => !$employee->is_active,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Statut modifié avec succès!');
    }
}