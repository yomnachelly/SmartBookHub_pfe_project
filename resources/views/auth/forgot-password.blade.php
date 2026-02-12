<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié — Smart Book Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md mx-auto px-4">

    <div class="text-center mb-8">
        <a href="{{ route('welcome') }}">
            <h1 class="text-3xl font-bold text-[#01B3BB]">Smart Book Hub</h1>
        </a>
        <p class="text-gray-500 text-sm mt-1">Réinitialisation du mot de passe</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-[#e6f9fa] rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#01B3BB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Mot de passe oublié ?</h2>
        <p class="text-gray-500 text-sm text-center mb-6">
            Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </p>

        @if (session('status'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg flex items-start gap-3">
                <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-700 text-sm">{{ session('status') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse e-mail
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="vous@exemple.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent
                           @error('email') border-red-400 @enderror"
                />
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-[#01B3BB] hover:bg-[#008D94] text-white font-bold py-3 px-6 rounded-xl transition duration-200">
                Envoyer le lien de réinitialisation
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-[#01B3BB] hover:underline">
                ← Retour à la connexion
            </a>
        </div>
    </div>

</div>
</body>
</html>