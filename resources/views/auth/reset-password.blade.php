<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe — Smart Book Hub</title>
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
                          d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Nouveau mot de passe</h2>
        <p class="text-gray-500 text-sm text-center mb-6">
            Choisissez un mot de passe sécurisé pour votre compte.
        </p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            {{-- password reset token (hidden) --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- email (read only) --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse e-mail
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autocomplete="username"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500
                           @error('email') border-red-400 @enderror"
                />
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Nouveau mot de passe
                </label>
                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Minimum 8 caractères"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent pr-12
                               @error('password') border-red-400 @enderror"
                    />
                    <button type="button" onclick="toggleVisibility('password', 'eye1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="eye1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmer le mot de passe
                </label>
                <div class="relative">
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Répétez le mot de passe"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#01B3BB] focus:border-transparent pr-12"
                    />
                    <button type="button" onclick="toggleVisibility('password_confirmation', 'eye2')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="eye2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <p id="match-hint" class="mt-2 text-xs hidden"></p>
            </div>

            <button
                type="submit"
                class="w-full bg-[#01B3BB] hover:bg-[#008D94] text-white font-bold py-3 px-6 rounded-xl transition duration-200">
                Réinitialiser le mot de passe
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-[#01B3BB] hover:underline">
                ← Retour à la connexion
            </a>
        </div>
    </div>

</div>

<script>
    function toggleVisibility(fieldId, eyeId) {
        const field = document.getElementById(fieldId);
        field.type = field.type === 'password' ? 'text' : 'password';
    }

    // live password match indicator
    const pw  = document.getElementById('password');
    const pwc = document.getElementById('password_confirmation');
    const hint = document.getElementById('match-hint');

    function checkMatch() {
        if (!pwc.value) { hint.classList.add('hidden'); return; }
        if (pw.value === pwc.value) {
            hint.textContent  = '✓ Les mots de passe correspondent';
            hint.className    = 'mt-2 text-xs text-green-600';
        } else {
            hint.textContent  = '✗ Les mots de passe ne correspondent pas';
            hint.className    = 'mt-2 text-xs text-red-500';
        }
    }

    pw.addEventListener('input', checkMatch);
    pwc.addEventListener('input', checkMatch);
</script>
</body>
</html>