@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- session status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- error msgs -->
    @if ($errors->any())
        <div class="mb-4">
            <div class="font-medium text-red-600 text-center">
                {{ __('Whoops! Something went wrong.') }}
            </div>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600 text-center">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg mx-auto mb-4">
                <img src="{{ asset('images/logooriginal.png') }}" alt="Logo" class="w-16 h-16">
            </div>
            <h2 class="text-3xl font-bold text-[#01B3BB] text-center">
                Se connecter
            </h2>
            <p class="mt-2 text-sm text-gray-600 text-center">
                Connectez-vous à votre compte Yeda
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-lg rounded-3xl sm:px-10">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               value="{{ old('email') }}"
                               required 
                               autofocus 
                               autocomplete="email"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                               placeholder="votre@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- pwd -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FFC62A] focus:border-[#FFC62A] transition"
                               placeholder="Votre mot de passe">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- remember + reset pwd -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" 
                               name="remember" 
                               type="checkbox" 
                               class="h-4 w-4 text-[#FFC62A] focus:ring-[#FFC62A] border-gray-300 rounded"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#01B3BB] hover:text-[#FFC62A] transition">
                            Mot de passe oublié?
                        </a>
                    @endif
                </div>

                <div class="mb-6">
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-medium text-[#1E1E1E] bg-[#FFC62A] hover:bg-[#FFD666] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFC62A] transition">
                        Se connecter
                    </button>
                </div>

                <!-- register link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Vous n'avez pas de compte?
                        <a href="{{ route('register') }}" class="font-medium text-[#01B3BB] hover:text-[#FFC62A] transition ml-1">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .shadow-lg {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    input:focus {
        outline: none;
        border-color: #FFC62A;
        box-shadow: 0 0 0 3px rgba(255, 198, 42, 0.1);
    }
</style>
@endsection