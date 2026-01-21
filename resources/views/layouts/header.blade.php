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
            
            @auth
                <!-- User is logged in -->
                <li class="relative group">
                    <a href="#" class="flex items-center gap-2 hover:text-[#FFC62A] transition">
                        <div class="w-8 h-8 bg-[#FFC62A] rounded-full flex items-center justify-center">
                            <span class="text-[#1E1E1E] font-bold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <!-- Dashboard based on role -->
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                                </svg>
                                Tableau de bord Admin
                            </a>
                        @elseif(Auth::user()->role === 'employee')
                            <a href="{{ route('employe.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                                </svg>
                                Tableau de bord Employé
                            </a>
                        @elseif(Auth::user()->role === 'client')
                            <a href="{{ route('client.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 text-[#01B3BB]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                                </svg>
                                Tableau de bord Client
                            </a>
                        @endif
                        
                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                            <svg class="w-5 h-5 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Mon Profil
                        </a>
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </li>
                
                <!-- Shopping Cart (only for clients) -->
                @if(Auth::user()->role === 'client')
                <li>
                    <a href="#" class="relative hover:text-[#FFC62A] transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-[#FFC62A] text-[#1E1E1E] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center"></span>
                    </a>
                </li>
                @endif
            @else
                <!-- User is not logged in -->
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
            @endauth          
        </ul>
    </nav>
</header>