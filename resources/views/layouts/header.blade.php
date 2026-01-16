<header class="bg-[#01B3BB] text-white rounded-bl-[50px] relative">
    <nav class="container mx-auto px-4 py-4 flex items-center justify-between relative">
        <!-- Logo -->
        <div class="absolute left-0 top-1/2 -translate-y-1/2 ml-4">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg">
                <img src="{{ asset('images/logooriginal.png') }}" alt="Logo" class="w-12 h-12">
            </div>
        </div>

        <!-- navbar links-->
        <ul class="flex items-center gap-8 text-base ml-auto mr-4">
            <li>
                <a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:text-[#FFC62A] transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Accueil
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-2 hover:text-[#FFC62A] transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    A propos
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-2 hover:text-[#FFC62A] transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    Contact
                </a>
            </li> 
            <li>
                <a href="{{ route('login') }}" class="flex items-center gap-2 hover:text-[#FFC62A] transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    Se connecter
                </a>
            </li>
            <li>
                <a href="#" class="relative hover:text-[#FFC62A] transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-[#FFC62A] text-[#1E1E1E] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center"></span>
                </a>
            </li>          
        </ul>
    </nav>
</header>