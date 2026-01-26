@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] rounded-t-3xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Gestion des Employés
                </h1>
                <p class="text-white/80 mt-2">
                    Gérez tous les employés de la plateforme Smart Book Hub
                </p>
                <div class="flex items-center mt-4 gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-white/90 hover:text-white flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.employees.create') }}" 
                   class="flex items-center gap-2 bg-[#FFC62A] text-[#1E1E1E] px-6 py-3 rounded-xl font-bold hover:bg-[#FFD666] transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Ajouter un employé
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Employés actifs</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $employees->where('is_active', true)->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Employés inactifs</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $employees->where('is_active', false)->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total employés</p>
                    <h3 class="text-2xl font-bold text-[#1E1E1E] mt-2">
                        {{ $employees->count() }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-[#01B3BB]/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Employees Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Liste des employés</h2>
                    <p class="text-gray-600 text-sm mt-1">
                        {{ $employees->count() }} employé(s) trouvé(s)
                    </p>
                </div>
                
                <!-- Filters -->
                <div class="flex flex-wrap gap-3">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher un employé..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                               id="searchInput">
                    </div>
                    
                    <select class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent"
                            id="statusFilter">
                        <option value="all">Tous les statuts</option>
                        <option value="active">Actifs seulement</option>
                        <option value="inactive">Inactifs seulement</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full" id="employeesTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Employé</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Contact</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Inscription</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Statut</th>
                        <th class="text-left py-4 px-6 text-gray-600 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50 transition employee-row" 
                        data-name="{{ strtolower($employee->name) }}"
                        data-status="{{ $employee->is_active ? 'active' : 'inactive' }}">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-[#01B3BB] rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900 block">{{ $employee->name }}</span>
                                    <span class="text-sm text-gray-500">ID: {{ $employee->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    <span class="text-sm">{{ $employee->email }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                    <span class="text-sm text-gray-500">Non spécifié</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <span class="text-sm text-gray-900 block">
                                    {{ $employee->created_at->format('d/m/Y') }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $employee->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if($employee->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Actif
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Inactif
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-wrap gap-2">
                                <!-- View Details Button -->
                                <button onclick="viewEmployee({{ $employee->id }})" 
                                        class="flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Détails
                                </button>
                                
                                <!-- Edit Button -->
                                <a href="{{ route('admin.employees.edit', $employee) }}" 
                                   class="flex items-center gap-1 px-3 py-1.5 bg-[#FFC62A]/10 text-[#FFC62A] rounded-lg hover:bg-[#FFC62A]/20 transition text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                    Modifier
                                </a>
                                
                                <!-- Toggle Status Button -->
                                <form method="POST" action="{{ route('admin.employees.toggle', $employee) }}" 
                                      class="inline" 
                                      onsubmit="return confirm('Voulez-vous vraiment {{ $employee->is_active ? 'désactiver' : 'activer' }} cet employé ?')">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center gap-1 px-3 py-1.5 rounded-lg transition text-sm 
                                                   {{ $employee->is_active ? 'bg-red-50 text-red-700 hover:bg-red-100' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            @if($employee->is_active)
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            @else
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            @endif
                                        </svg>
                                        {{ $employee->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                
                                @if(false)
                                <form method="POST" action="{{ route('admin.employees.destroy', $employee) }}" 
                                      class="inline" 
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cet employé ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="flex items-center gap-1 px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition text-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 px-6 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.223.447-.481.801-.78 1H22a2 2 0 002-2v-2a2 2 0 00-2-2h-1.28c-.299-.199-.557-.553-.78-1-.446-.894-1.048-1.5-1.78-1.5s-1.334.606-1.78 1.5c-.223.447-.481.801-.78 1H10a2 2 0 00-2 2v2a2 2 0 002 2h1.28c.299.199.557.553.78 1 .446.894 1.048 1.5 1.78 1.5s1.334-.606 1.78-1.5c.223-.447.481-.801.78-1H22a2 2 0 002-2v-2a2 2 0 00-2-2h-1.28z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun employé trouvé</h3>
                                <p class="text-gray-500 mb-4">Commencez par ajouter votre premier employé</p>
                                <a href="{{ route('admin.employees.create') }}" 
                                   class="flex items-center gap-2 bg-[#01B3BB] text-white px-4 py-2 rounded-xl hover:bg-[#008D94] transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Ajouter un employé
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($employees->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $employees->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // search
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.employee-row');
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const rows = document.querySelectorAll('.employee-row');
        
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'all' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function viewEmployee(employeeId) {

        window.location.href = `/admin/employees/${employeeId}/edit`;
    }

    function exportEmployees(format) {
        alert(`Exporting employees data in ${format} format...`);
    }
</script>

<style>
    .employee-row {
        transition: all 0.2s ease;
    }
    
    .employee-row:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    th {
        position: sticky;
        top: 0;
        background-color: #f9fafb;
        z-index: 10;
    }
</style>
@endsection