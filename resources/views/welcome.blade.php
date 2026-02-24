@extends('layouts.app')

@section('content')
<div class="h-8"></div>
<section class="relative overflow-hidden bg-[#01B3BB]">
    
</section>
    <section class="relative overflow-hidden bg-[#01B3BB]">
        <div class="absolute inset-0 bg-gradient-to-br from-[#01B3BB] via-[#2ac8d0] to-[#4ECFD7]">
            <div class="absolute inset-0 opacity-[0.02] bg-[radial-gradient(circle_at_30%_40%,_white_0px,_transparent_1px)] bg-[length:40px_40px]"></div>
            
            <div class="absolute top-1/4 -left-20 w-72 h-72 bg-gradient-to-r from-[#FFC62A]/10 to-[#FFD666]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-gradient-to-l from-white/5 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-[#01B3BB]/20 to-transparent rounded-full blur-3xl"></div>
        </div>
        
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
        
        <div class="container relative mx-auto px-4 py-20 md:py-24">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-16 lg:gap-12">
                <div class="w-full lg:w-2/5 order-2 lg:order-1">
                    <div class="relative flex justify-center lg:justify-start">
                        <div class="relative group cursor-pointer w-4/5 lg:w-3/4">
                            <div class="relative rounded-2xl overflow-hidden border border-white/30 bg-white/10 backdrop-blur-xl shadow-2xl">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/15 to-transparent"></div>
                                
                                <img src="/images/books-collection.png" alt="مجموعة الكتب" 
                                    class="w-full transform transition-all duration-700 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-[#01B3BB]/30 via-transparent to-transparent 
                                            opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                            
                            <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 
                                        bg-white/95 backdrop-blur-xl text-[#01B3BB] text-sm font-semibold 
                                        px-5 py-2.5 rounded-full border border-white/40 shadow-lg
                                        transition-all duration-300 group-hover:scale-105">
                                +50 إصدار
                            </div>
                        </div>
                    </div>
                </div>
<div class="w-full lg:w-3/5 text-center order-1 lg:order-2 px-4 lg:px-0">
    <div id="heroCarousel" class="relative overflow-hidden">
        
        <!-- Slides wrapper -->
        <div class="flex transition-transform duration-700 ease-in-out" id="heroSlides">

            <!-- Slide 1 -->
            <div class="min-w-full">
                <div class="inline-flex items-center gap-3 mb-8 px-4 py-2.5 
                        bg-white/15 backdrop-blur-sm rounded-full border border-white/25">
                    <div class="w-2 h-2 rounded-full bg-[#FFC62A] animate-pulse"></div>
                    <span class="text-white/95 text-sm font-medium tracking-wider">
                        مكتبة تعليمية متخصصة
                    </span>
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extralight tracking-tight text-white mb-6 leading-[1.05]">
                    <span class="block mb-2">إصدارات</span>
                    <span class="font-bold bg-gradient-to-r from-white via-white/95 to-white/90 
                                bg-clip-text text-transparent drop-shadow-lg">
                         طارق البريكي
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-white/85 mb-10 font-light tracking-wide leading-relaxed max-w-2xl mx-auto">
                    منصة لبيع الكتب التعليمية بطريقة سهلة وسريعة
                </p>
            </div>
  <!-- Slide 4 -->
<div class="min-w-full text-center">

    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extralight tracking-tight text-white mb-6 leading-[1.05]">
        تجربة شراء سهلة
    </h1>

    <p class="text-xl md:text-2xl text-white/85 mb-10 font-light tracking-wide leading-relaxed max-w-2xl mx-auto">
        إضافة للسلة • قائمة المفضلة • بحث سريع
    </p>

    <!-- ANIMATION LOTTIE -->
    <div class="flex justify-center mb-10">
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 shadow-xl">
            <dotlottie-wc
                src="https://lottie.host/a18e8bd3-5804-435d-a342-e51f247209c5/7tQ1cO0ocZ.lottie"
                class="w-[100px] h-[100px] md:w-[100px] md:h-[100px]"
                autoplay
                loop>
            </dotlottie-wc>
        </div>
    </div>

</div>
          <!-- Slide 2 -->
<div class="min-w-full flex flex-col md:flex-row items-center justify-between gap-10">

    <!-- TEXTE -->
    <div class="text-center md:text-left max-w-2xl">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extralight tracking-tight text-white mb-6 leading-[1.05]">
            À propos
        </h1>

        <p class="text-lg md:text-xl text-white/85 mb-10 font-light tracking-wide leading-relaxed">
            Découvrez la plateforme, son objectif et le parcours de l’auteur.
        </p>

        <a href="{{ route('apropos') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-white/15 backdrop-blur-sm 
                  border border-white/25 rounded-full text-white font-medium 
                  hover:bg-white/25 hover:scale-105 transition group">
            
            <svg class="w-5 h-5 animate-pulse group-hover:animate-bounce transition" 
                 fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" 
                      d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" 
                      clip-rule="evenodd"/>
            </svg>

            <span>Voir la page</span>
        </a>
    </div>

    <!-- ANIMATION LOTTIE -->
    <div class="flex justify-center md:justify-end">
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 shadow-xl">
            <dotlottie-wc
                src="https://lottie.host/67f181d6-1e6e-4cf9-a160-3987acaaa1bd/GPRikcyAkI.lottie"
                class="w-[260px] h-[260px] md:w-[320px] md:h-[320px]"
                autoplay
                loop>
            </dotlottie-wc>
        </div>
    </div>

</div>
<!-- Slide 5 -->
<div class="min-w-full flex flex-col lg:flex-row items-center justify-center gap-10 px-4 lg:px-20">

    <!-- Texte à gauche -->
    <div class="text-center lg:text-left max-w-lg">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extralight tracking-tight text-white mb-6 leading-[1.05]">
            Assistant Intelligent
        </h1>

        <p class="text-xl md:text-2xl text-white/85 mb-10 font-light tracking-wide leading-relaxed">
            Pose tes questions et obtiens des réponses instantanées grâce à notre assistant intelligent.
        </p>
    </div>

    <!-- Animation à droite -->
    <div class="flex justify-center lg:justify-end">
        <dotlottie-wc
            src="https://lottie.host/9e3bc69d-44b3-4dc6-9406-41618e7901ea/tH4fbbH7L9.lottie"
            class="w-[300px] h-[300px] md:w-[400px] md:h-[400px]"
            autoplay
            loop>
        </dotlottie-wc>
    </div>

</div>
           <!-- Slide 3 -->
<div class="min-w-full flex flex-col md:flex-row items-center justify-between gap-10">

    <!-- TEXTE -->
    <div class="text-center md:text-left max-w-2xl">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extralight tracking-tight text-white mb-6 leading-[1.05]">
            Contact
        </h1>

        <p class="text-lg md:text-xl text-white/85 mb-10 font-light tracking-wide leading-relaxed">
            Une question ou une demande ? N’hésitez pas à nous contacter.
        </p>

        <a href="{{ route('contact') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-white/15 backdrop-blur-sm 
                  border border-white/25 rounded-full text-white font-medium 
                  hover:bg-white/25 hover:scale-105 transition group">
            
            <svg class="w-5 h-5 animate-pulse group-hover:animate-bounce transition" 
                 fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
            </svg>

            <span>Envoyer un message</span>
        </a>
    </div>

    <!-- ANIMATION LOTTIE -->
    <div class="flex justify-center md:justify-end">
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 shadow-xl">
            <dotlottie-wc
                src="https://lottie.host/dd656bd3-c27a-4820-b408-6d5bd033427b/k2ATZasDuC.lottie"
                class="w-[260px] h-[260px] md:w-[320px] md:h-[320px]"
                autoplay
                loop>
            </dotlottie-wc>
        </div>
    </div>

</div>

          

        </div>
    </div>
</div>
                <!-- Author image -->
                <div class="w-full lg:w-2/5 order-3">
                    <div class="relative flex justify-center lg:justify-end">
                        <div class="relative group w-4/5 lg:w-3/4">
                            <div class="relative rounded-2xl overflow-hidden border border-white/30 
                                        bg-white/10 backdrop-blur-xl shadow-2xl">
                                <div class="absolute inset-0 bg-gradient-to-tr from-white/15 to-transparent"></div>
                                
                                <img src="/images/author.png" alt="طارق البريكي" 
                                    class="w-full transform transition-all duration-700 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-[#01B3BB]/30 via-transparent to-transparent 
                                            opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                            
                            <div class="absolute -bottom-4 right-6 
                                        bg-white/95 backdrop-blur-xl text-[#01B3BB] text-sm font-semibold 
                                        px-4 py-2 rounded-full border border-white/40 shadow-lg
                                        transition-all duration-300 group-hover:scale-105">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                    </svg>
                                    المؤلف
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0 h-48 
                    bg-gradient-to-t from-white/10 via-white/5 to-transparent pointer-events-none"></div>
        
        <div class="absolute top-1/4 left-10">
            <div class="w-1 h-1 rounded-full bg-white/30 animate-pulse"></div>
            <div class="w-2 h-2 rounded-full bg-white/20 ml-4 mt-2 animate-pulse" style="animation-delay: 0.3s"></div>
        </div>
        <div class="absolute bottom-1/3 right-12">
            <div class="w-2 h-2 rounded-full bg-white/25 animate-pulse" style="animation-delay: 0.7s"></div>
            <div class="w-1 h-1 rounded-full bg-white/15 -ml-3 mt-3 animate-pulse" style="animation-delay: 1s"></div>
        </div>
    </section>
{{-- ====================== BANDE ORANGE STICKY ====================== --}}
<nav class="sticky top-0 z-[60] bg-[#FFC62A] shadow-lg py-4">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        
        <!-- Dropdown "Toute Les Catégories" (exactement comme l'image) -->
        <div class="relative w-72">
            <select 
                id="topCategorySelect"
                onchange="applyTopCategory(this.value)"
                class="w-full bg-white text-[#1E1E1E] font-semibold text-base px-6 py-3.5 rounded-3xl border-0 focus:outline-none focus:ring-4 focus:ring-white/50 appearance-none cursor-pointer">
                
                <option value="">Toute Les Catégories</option>
                
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $id => $name)
                        @if(!empty($name))
                            <option value="{{ e($id) }}" {{ request('categorie') == $id ? 'selected' : '' }}>
                                {{ e($name) }}
                            </option>
                        @endif
                    @endforeach
                @endif
            </select>
            
            <!-- Flèche personnalisée -->
            <div class="pointer-events-none absolute right-6 top-1/2 -translate-y-1/2 text-[#1E1E1E]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>

        <!-- Liens de la barre (exactement comme l'image) -->
        <div class="flex items-center gap-x-9 text-white font-semibold text-[15px] tracking-wide">
            <a href="{{ url('/') }}?sort=best" class="hover:text-[#FFC62A] transition-colors">Meilleures Ventes</a>
            <a href="{{ url('/') }}?categorie=developpement-personnel" class="hover:text-[#FFC62A] transition-colors">Développement Personnel</a>
            <a href="{{ url('/') }}?sort=popular" class="hover:text-[#FFC62A] transition-colors">Les Plus Populaires</a>
            <a href="{{ url('/') }}?promo=1" class="hover:text-[#FFC62A] transition-colors">Promotions</a>
            <a href="{{ url('/') }}?sort=new" class="hover:text-[#FFC62A] transition-colors">Nouveautés</a>
        </div>
    </div>
</nav>
{{-- ====================== FIN BANDE ORANGE ====================== --}}
<script>
function applyTopCategory(value) {
    let url = new URL(window.location.href);
    
    if (value) {
        url.searchParams.set('categorie', value);
    } else {
        url.searchParams.delete('categorie');
    }
    // garder les autres filtres (search, prix, etc.)
    window.location.href = url.toString();
}
</script>
    <!-- main -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex gap-6">
            <main class="flex-1">
                <!-- search bar -->
                <form method="GET" action="{{ url('/') }}" class="flex gap-4 mb-8">
                    <input type="text" name="search" placeholder="Taper ici" value="{{ request('search') }}" class="flex-1 px-6 py-4 rounded-full bg-[#D4F1F4] text-[#1E1E1E] text-left placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#01B3BB]">
                    <button type="submit" class="bg-[#FFC62A] text-[#1E1E1E] px-8 py-4 rounded-full font-bold hover:bg-[#FFD666] transition">
                        Chercher
                    </button>
                </form>
<!-- Petit carrousel des nouveaux livres -->
@php
    $nouveauxLivres = $livres->filter(function($livre) {
        return \Carbon\Carbon::parse($livre->created_at)->diffInDays(now()) <= 7;
    })->take(6); // Limiter à 6 nouveaux livres maximum
@endphp

@if($nouveauxLivres->count() > 0)
<div class="mb-12">
    <div class="flex items-center gap-3 mb-4">
        <div class="bg-[#FFC62A] p-2 rounded-full">
            <svg class="w-5 h-5 text-[#1E1E1E]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-[#1E1E1E]">Nouveautés de la semaine</h2>
        <span class="bg-[#01B3BB] text-white text-sm px-3 py-1 rounded-full">{{ $nouveauxLivres->count() }} nouveaux livres</span>
    </div>
    
    <div class="relative group/carousel">
        <!-- Carousel container plus petit que la grille normale -->
        <div class="overflow-hidden rounded-xl">
            <div id="newBooksCarousel" class="flex transition-transform duration-500 ease-in-out gap-4">
                @foreach($nouveauxLivres as $livre)
                <div class="min-w-[180px] md:min-w-[200px] flex-shrink-0">
                    <div class="book-card-small bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition relative">
                        @if(\Carbon\Carbon::parse($livre->created_at)->diffInDays(now()) <= 7)
                        <div class="absolute top-1 right-1 z-20 w-10 h-10 pointer-events-none">
                            <dotlottie-wc
                                src="https://lottie.host/3905217e-800c-43ed-8deb-57fd9de150e1/exJ2kIkPnp.lottie"
                                autoplay
                                loop
                                style="width: 100%; height: 100%;">
                            </dotlottie-wc>
                        </div>
                        @endif
                        
                        <a href="{{ route('book.show', $livre->id_livre) }}" class="absolute inset-0 z-10"></a>
                        
                        <div class="relative">
                            @if($livre->image && file_exists(storage_path('app/public/' . $livre->image)))
                                <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-36 object-cover">
                            @else
                                <div class="w-full h-36 bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-3">
                            <h4 class="font-bold text-[#1E1E1E] text-sm mb-1 truncate">{{ $livre->titre }}</h4>
                            <p class="text-[#FFC62A] font-bold text-base">{{ number_format($livre->prix, 3) }} dt</p>
                            <p class="text-gray-600 text-xs truncate">{{ $livre->auteur }}</p>
                            <div class="mt-1">
                                @if($livre->stock > 0)
                                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800">
                                        En stock
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Boutons de navigation (optionnels) -->
        @if($nouveauxLivres->count() > 4)
        <button onclick="slideNewBooks('prev')" class="absolute -left-3 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 shadow-lg opacity-0 group-hover/carousel:opacity-100 transition-opacity z-30 hover:bg-gray-100">
            <svg class="w-5 h-5 text-[#1E1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button onclick="slideNewBooks('next')" class="absolute -right-3 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 shadow-lg opacity-0 group-hover/carousel:opacity-100 transition-opacity z-30 hover:bg-gray-100">
            <svg class="w-5 h-5 text-[#1E1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        @endif
    </div>
</div>

<style>
.book-card-small {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.book-card-small:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
}
</style>

<script>
let newBooksIndex = 0;
const newBooksCarousel = document.getElementById('newBooksCarousel');
if (newBooksCarousel) {
    const totalNewBooks = {{ $nouveauxLivres->count() }};
    const visibleItems = window.innerWidth < 768 ? 2 : 4; // 2 items sur mobile, 4 sur desktop
    
    // Auto-slide toutes les 4 secondes
    setInterval(() => {
        if (totalNewBooks > visibleItems) {
            newBooksIndex = (newBooksIndex + 1) % (totalNewBooks - visibleItems + 1);
            const slideWidth = newBooksCarousel.children[0].offsetWidth + 16; // width + gap
            newBooksCarousel.style.transform = `translateX(-${newBooksIndex * slideWidth}px)`;
        }
    }, 4000);
}

function slideNewBooks(direction) {
    const carousel = document.getElementById('newBooksCarousel');
    const totalBooks = carousel.children.length;
    const visibleItems = window.innerWidth < 768 ? 2 : 4;
    const slideWidth = carousel.children[0].offsetWidth + 16; // width + gap
    
    if (direction === 'next' && newBooksIndex < totalBooks - visibleItems) {
        newBooksIndex++;
    } else if (direction === 'prev' && newBooksIndex > 0) {
        newBooksIndex--;
    }
    
    carousel.style.transform = `translateX(-${newBooksIndex * slideWidth}px)`;
}
</script>
@endif
<!-- Titre simple avant tous les livres -->
<div class="mb-4">
    <h2 class="text-2xl font-bold text-[#1E1E1E] inline-block">
        Tous nos livres
    </h2>
    <span class="ml-3 bg-[#01B3BB] text-white text-sm px-3 py-1 rounded-full">
        {{ $livres->total() ?? count($livres) }} livres
    </span>
</div>
                <!-- books -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if(isset($livres) && count($livres) > 0)
                        @foreach($livres as $livre)
                        <div class="book-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition relative group cursor-pointer">
                         @if(\Carbon\Carbon::parse($livre->created_at)->diffInDays(now()) <= 7)
    <div class="absolute top-2 right-2 z-20 w-14 h-14 pointer-events-none">
        <dotlottie-wc
            src="https://lottie.host/3905217e-800c-43ed-8deb-57fd9de150e1/exJ2kIkPnp.lottie"
            autoplay
            loop
            style="width: 100%; height: 100%;">
        </dotlottie-wc>
    </div>
@endif
                        <a href="{{ route('book.show', $livre->id_livre) }}" class="absolute inset-0 z-10"></a>
                            
                            <div class="relative">
                                @if($livre->image && file_exists(storage_path('app/public/' . $livre->image)))
                                    <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-r from-[#01B3BB] to-[#4ECFD7] flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="hover-actions absolute top-4 left-4 flex gap-2
            opacity-0 invisible transition-all duration-300
            group-hover:opacity-100 group-hover:visible">
                                    @if($livre->stock > 0)
                                    <form method="POST" action="{{ route('panier.ajouter', $livre->id_livre) }}" class="z-20 relative">
                                        @csrf
                                        <button type="submit" class="bg-[#FFC62A] text-[#1E1E1E] px-4 py-2 rounded-lg font-semibold hover:bg-[#FFD666] transition flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z"/>
                                            </svg>
                                            Ajouter
                                        </button>
                                    </form>
                                    @else
                                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded-lg font-semibold cursor-not-allowed" disabled>
                                        Rupture
                                    </button>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('client.wishlist.add', $livre->id_livre) }}" class="wishlist-form z-20 relative">
                                        @csrf
                                        <button type="submit" class="bg-white p-2 rounded-lg hover:bg-gray-100 transition">
                                            @if(auth()->check() && isset($livre->is_in_wishlist) && $livre->is_in_wishlist)
                                                <!-- filled heart -->
                                                <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            @else
                                                <!-- empty heart -->
                                                <svg class="w-6 h-6 text-[#FFC62A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-[#1E1E1E] mb-2 truncate">{{ $livre->titre }}</h4>
                                <p class="text-[#FFC62A] font-bold text-lg">{{ number_format($livre->prix, 3) }} dt</p>
                                <p class="text-gray-600 text-sm">{{ $livre->auteur }}</p>
                                <div class="mt-1">
                                    @if($livre->categories && $livre->categories->count() > 0)
                                        @foreach($livre->categories->take(2) as $categorie)
                                            <span class="inline-block text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded-full mr-1">
                                                {{ $categorie->nom_categ }}
                                            </span>
                                        @endforeach
                                        @if($livre->categories->count() > 2)
                                            <span class="text-xs text-gray-500">+{{ $livre->categories->count() - 2 }} plus</span>
                                        @endif
                                    @elseif($livre->categorie)
                                        <span class="text-gray-500 text-xs">{{ $livre->categorie }}</span>
                                    @endif
                                </div>
                                
                                <!-- stock -->
                                <div class="mt-2">
                                    @if($livre->stock > 0)
                                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800">
                                            En stock ({{ $livre->stock }})
                                        </span>
                                    @else
                                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800">
                                            Rupture
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-span-4 text-center py-12">
                            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <p class="text-gray-500 text-lg mb-2">Aucun livre trouvé</p>
                            @if(request()->filled('search') || request()->filled('categorie') || request()->filled('min_price') || request()->filled('max_price'))
                                <p class="text-gray-400 mb-4">Essayez de modifier vos critères de recherche</p>
                                <a href="{{ url('/') }}" class="text-[#01B3BB] hover:underline">
                                    Voir tous les livres →
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="mt-10 flex justify-center">
    {{ $livres->links('pagination::tailwind') }}   <!-- ou simple, bootstrap-4/5, etc. -->
</div>
            </main>

            <!-- sidebar filter -->
            <aside class="w-64">
                <div class="bg-[#01B3BB] text-white rounded-t-3xl p-6">
                    <h3 class="text-xl font-bold mb-6">Choisir une catégorie</h3>
                    <!-- by category -->
                    <form method="GET" action="{{ url('/') }}" id="categoryForm">
                        @if(request()->filled('search'))
                            <input type="hidden" name="search" value="{{ e(request('search')) }}">
                        @endif
                        @if(request()->filled('min_price'))
                            <input type="hidden" name="min_price" value="{{ e(request('min_price')) }}">
                        @endif
                        @if(request()->filled('max_price'))
                            <input type="hidden" name="max_price" value="{{ e(request('max_price')) }}">
                        @endif
                        
                       <select id="categorieSelect"
        name="categorie" 
        onchange="this.form.submit()" 
        class="w-full p-3 rounded-lg text-[#1E1E1E] bg-white border-2 border-gray-200 
               focus:outline-none focus:border-[#FFC62A] animate-pulse">
                            <option value="">Toutes les catégories</option>
                            @if(isset($categories) && count($categories) > 0)
                                @foreach($categories as $id => $name)
                                    @if(!empty($name))
                                        <option value="{{ e($id) }}" {{ request('categorie') == $id ? 'selected' : '' }}>
                                            {{ e($name) }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </form>

                    <!-- by price -->
                    <h3 class="text-xl font-bold mt-8 mb-4">Choisir un prix (dt)</h3>
                    <div class="px-2">                        
                        <form method="GET" action="{{ url('/') }}" id="priceForm">
                            @if(request()->filled('search'))
                                <input type="hidden" name="search" value="{{ e(request('search')) }}">
                            @endif
                            @if(request()->filled('categorie'))
                                <input type="hidden" name="categorie" value="{{ e(request('categorie')) }}">
                            @endif
                            
                            <div class="mt-6 pt-4 border-t border-white/30">
                                <h4 class="font-bold mb-3">Plage de prix:</h4>
                                <div class="space-y-2">
                                    <button type="submit" name="clear_price" value="1" class="w-full text-left px-3 py-2 rounded-lg transition 
                                                {{ !request()->filled('min_price') && !request()->filled('max_price') ? 
                                                    'bg-[#FFC62A] text-[#1E1E1E] font-bold' : 
                                                    'bg-white/10 hover:bg-white/20' }}">
                                        Tous les prix
                                    </button>
                                    
                                    <!-- dynamic prices range -->
                                    @if(isset($plagesPrix) && count($plagesPrix) > 0)
                                        @foreach($plagesPrix as $plage)
                                            <button type="submit" name="apply_price_range" value="{{ e($plage['min']) }}_{{ e($plage['max']) }}" class="w-full text-left px-3 py-2 rounded-lg transition 
                                                        {{ request('min_price') == $plage['min'] && request('max_price') == $plage['max'] ? 
                                                            'bg-[#FFC62A] text-[#1E1E1E] font-bold' : 
                                                            'bg-white/10 hover:bg-white/20' }}">
                                                {{ e($plage['label']) }}
                                                <span class="text-xs opacity-75 float-right">({{ e($plage['count']) }})</span>
                                            </button>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-center opacity-75">Aucune plage de prix disponible</p>
                                    @endif
                                    
                                </div>
                            </div>
                        </form>
                        
                        <!-- custom price filter -->
                        <div class="mt-6 pt-4 border-t border-white/30">
                            <h4 class="font-bold mb-3">Prix personnalisé:</h4>
                            <form method="GET" action="{{ url('/') }}">
                                @if(request()->filled('search'))
                                    <input type="hidden" name="search" value="{{ e(request('search')) }}">
                                @endif
                                @if(request()->filled('categorie'))
                                    <input type="hidden" name="categorie" value="{{ e(request('categorie')) }}">
                                @endif
                                
                                <div class="grid grid-cols-2 gap-2 mb-3">
                                    <div>
                                        <label class="block text-sm mb-1">Min (dt)</label>
                                        <input type="number" name="min_price" min="0" max="10000" step="0.5" 
                                               value="{{ request('min_price', '') }}" 
                                               class="w-full p-2 rounded text-[#1E1E1E]">
                                    </div>
                                    <div>
                                        <label class="block text-sm mb-1">Max (dt)</label>
                                        <input type="number" name="max_price" min="0" max="10000" step="0.5" 
                                               value="{{ request('max_price', '') }}" 
                                               class="w-full p-2 rounded text-[#1E1E1E]">
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" 
                                            class="flex-1 bg-[#FFC62A] text-[#1E1E1E] px-3 py-2 rounded font-bold hover:bg-[#FFD666] transition">
                                        Appliquer
                                    </button>
                                    @if(request()->filled('min_price') || request()->filled('max_price'))
                                    <a href="{{ url('/') }}?{{ http_build_query(request()->except(['min_price', 'max_price', 'page'])) }}"
                                       class="flex-1 bg-white/20 text-center px-3 py-2 rounded hover:bg-white/30 transition">
                                        Effacer
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        
                        @if(request()->filled('search') || request()->filled('categorie') || request()->filled('min_price') || request()->filled('max_price'))
                        <div class="mt-6 pt-4 border-t border-white/30">
                            <h4 class="font-bold mb-3">Filtres actifs:</h4>
                            <div class="space-y-2">
                                @if(request()->filled('search'))
                                <div class="flex items-center justify-between bg-white/10 p-2 rounded">
                                    <span class="text-sm">Recherche: "{{ e(request('search')) }}"</span>
                                    <a href="{{ url('/') }}?{{ http_build_query(request()->except(['search', 'page'])) }}"
                                       class="text-white/70 hover:text-white">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                                @endif
                                
                                @if(request()->filled('categorie'))
                                <div class="flex items-center justify-between bg-white/10 p-2 rounded">
                                    <span class="text-sm">Catégorie: {{ e(request('categorie')) }}</span>
                                    <a href="{{ url('/') }}?{{ http_build_query(request()->except(['categorie', 'page'])) }}"
                                       class="text-white/70 hover:text-white">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                                @endif
                                
                                @if(request()->filled('min_price') && request()->filled('max_price'))
                                <div class="flex items-center justify-between bg-white/10 p-2 rounded">
                                    <span class="text-sm">Prix: {{ e(request('min_price')) }}dt - {{ e(request('max_price')) }}dt</span>
                                    <a href="{{ url('/') }}?{{ http_build_query(request()->except(['min_price', 'max_price', 'page'])) }}"
                                       class="text-white/70 hover:text-white">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                                @endif
                                
                                <a href="{{ url('/') }}" class="block w-full text-center mt-4 bg-white/20 hover:bg-white/30 text-white px-3 py-2 rounded transition">
                                    Effacer tous les filtres
                                </a>
                            </div>
                        </div>
                        @endif
                        
                    </div>
                    <!-- Tutoriel Vidéo -->
<div class="mt-10 pt-6 border-t border-white/30">
    <h3 class="text-xl font-bold mb-4">Comment utiliser la plateforme ?</h3>
    <p class="text-sm text-white/90 mb-4 leading-relaxed">
        Découvrez en moins de 3 minutes comment naviguer, chercher et acheter vos livres facilement.
    </p>

    <div class="relative rounded-xl overflow-hidden shadow-2xl border border-white/20 bg-black/20 backdrop-blur-sm">
        <div class="aspect-video">
            <iframe 
                class="absolute inset-0 w-full h-full"
                src="https://www.youtube.com/embed/63YybNw9hzY?si=2EytMYc3_hAWDDIY"
                title="Tutoriel utilisation plateforme"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>
                </div>
            </aside>
            
        </div>
        {{-- ====================== CAROUSEL CATÉGORIES (comme la photo) ====================== --}}
{{-- ====================== CAROUSEL CATÉGORIES (version corrigée + petite) ====================== --}}
{{-- ====================== CAROUSEL CATÉGORIES (images livres réelles + petite taille) ====================== --}}
<div class="mb-16">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-[#FFC62A] p-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1E1E1E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-[#1E1E1E]">Découvrez nos catégories</h2>
    </div>

    <div class="relative group/carousel">
        <div class="overflow-hidden rounded-2xl">
            <div id="categoriesCarousel" class="flex transition-transform duration-500 ease-in-out gap-4">
                @php
                    // Tableau d'images fixes par catégorie (ajoute/enlève selon tes vraies catégories)
                    $categoryImages = [
                        'livres-enfants' => 'https://thumbs.dreamstime.com/b/stack-children-s-story-books-colorful-covers-isolated-white-colorful-stack-children-s-story-books-displayed-368866956.jpg',
                        'mangas-bandes-dessinees' => 'https://c8.alamy.com/comp/BHJ3E3/manga-japanese-comic-books-in-a-pile-BHJ3E3.jpg',
                        'romans' => 'https://hips.hearstapps.com/hmg-prod/images/elle-book-romance-2025-lead-694c0b8d72dc7.jpg?crop=0.8888888888888888xw:1xh;center,top&resize=1200:*',
                        'developpement-personnel' => 'https://www.myselfhelphabit.co.uk/wp-content/uploads/2023/02/Personal-Development-Books-IMG_5196.jpg',
                        'paperbacks' => 'https://www.bookclique.org/wp-content/uploads/book-hoarding-1024x614.jpg',
                        // Ajoute 'puzzle' si tu as la catégorie : 'puzzle' => 'URL_ICI',
                        // Pour les autres, mets une image générique de pile de livres
                        'default' => 'https://thumbs.dreamstime.com/b/stack-colorful-children-s-storybooks-learning-creative-imagination-charming-vibrantly-colored-books-invites-young-368866972.jpg',
                    ];
                @endphp

                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $id => $name)
                        @php
                            // Normalise le nom pour matcher les clés (minuscules, tirets, etc.)
                            $key = strtolower(str_replace(' ', '-', $name));
                            $key = str_replace(['&', ' et '], '-', $key);
                            $imageUrl = $categoryImages[$key] ?? $categoryImages['default'];
                        @endphp

                        <div class="min-w-[150px] md:min-w-[170px] flex-shrink-0">
                            <div class="category-card bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <a href="{{ url('/') }}?categorie={{ e($id) }}" class="block">
                                    <div class="relative">
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ e($name) }}" 
                                             class="w-full h-[140px] md:h-[150px] object-cover">
                                    </div>
                                    <div class="p-3.5 text-center">
                                        <h4 class="font-bold text-[#1E1E1E] text-[14px] md:text-[15px] leading-tight">{{ e($name) }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @if(isset($categories) && count($categories) > 3)
        <button onclick="slideCategories('prev')" 
                class="absolute -left-3 top-1/2 -translate-y-1/2 bg-white rounded-full p-2.5 shadow-xl opacity-0 group-hover/carousel:opacity-100 transition z-30 hover:bg-gray-100">
            <svg class="w-5 h-5 text-[#1E1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button onclick="slideCategories('next')" 
                class="absolute -right-3 top-1/2 -translate-y-1/2 bg-white rounded-full p-2.5 shadow-xl opacity-0 group-hover/carousel:opacity-100 transition z-30 hover:bg-gray-100">
            <svg class="w-5 h-5 text-[#1E1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        @endif
    </div>
</div>
   <script>
let categoriesIndex = 0;
const categoriesCarousel = document.getElementById('categoriesCarousel');

if (categoriesCarousel) {
    const total = categoriesCarousel.children.length;
    const visibleItems = window.innerWidth < 768 ? 2 : 4;

    // Auto-slide
    setInterval(() => {
        if (total > visibleItems) {
            categoriesIndex = (categoriesIndex + 1) % (total - visibleItems + 1);
            const slideWidth = categoriesCarousel.children[0].offsetWidth + 16; // gap-4
            categoriesCarousel.style.transform = `translateX(-${categoriesIndex * slideWidth}px)`;
        }
    }, 4500);
}

function slideCategories(direction) {
    const carousel = document.getElementById('categoriesCarousel');
    if (!carousel) return;

    const total = carousel.children.length;
    const visibleItems = window.innerWidth < 768 ? 2 : 4;
    const slideWidth = carousel.children[0] ? carousel.children[0].offsetWidth + 16 : 0;

    if (direction === 'next' && categoriesIndex < total - visibleItems) categoriesIndex++;
    else if (direction === 'prev' && categoriesIndex > 0) categoriesIndex--;

    carousel.style.transform = `translateX(-${categoriesIndex * slideWidth}px)`;
}
</script>
        <!-- BANDEAU NEWSLETTER FNAC - PLUS BAS + PLUS ÉTROIT + SCRIPT FIXÉ -->
    
   
    <script>
    const slides = document.getElementById('heroSlides');
    const totalSlides = slides.children.length;
    let index = 0;

    setInterval(() => {
        index = (index + 1) % totalSlides;
        slides.style.transform = `translateX(-${index * 100}%)`;
    }, 2600);
</script>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceForm = document.getElementById('priceForm');
        if (priceForm) {
            priceForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const clearPrice = e.submitter && e.submitter.name === 'clear_price';
                const applyPriceRange = e.submitter && e.submitter.name === 'apply_price_range';
                
                if (clearPrice) {
                    const formData = new FormData(this);
                    formData.delete('min_price');
                    formData.delete('max_price');
                    formData.delete('clear_price');
                    
                    const params = new URLSearchParams();
                    for (let [key, value] of formData.entries()) {
                        if (value) params.append(key, value);
                    }
                    
                    window.location.href = '{{ url("/") }}?' + params.toString();
                } else if (applyPriceRange) {
                    const [minPrice, maxPrice] = e.submitter.value.split('_');
                    
                    const formData = new FormData(this);
                    formData.set('min_price', minPrice);
                    formData.set('max_price', maxPrice);
                    formData.delete('apply_price_range');
                    
                    const params = new URLSearchParams();
                    for (let [key, value] of formData.entries()) {
                        if (value) params.append(key, value);
                    }
                    
                    window.location.href = '{{ url("/") }}?' + params.toString();
                } else {
                    this.submit();
                }
                const categorieSelect = document.getElementById('categorieSelect');

if (categorieSelect) {
    if (categorieSelect.value !== "") {
        categorieSelect.classList.remove('animate-pulse');
    }

    categorieSelect.addEventListener('change', function () {
        this.classList.remove('animate-pulse');
    });
}
            });
        }
        
        const bookCards = document.querySelectorAll('.book-card');
        bookCards.forEach(card => {
            const hoverActions = card.querySelector('.hover-actions');
            
            card.addEventListener('mouseenter', () => {
                hoverActions.classList.remove('opacity-0', 'invisible');
                hoverActions.classList.add('opacity-100', 'visible');
            });
            
            card.addEventListener('mouseleave', () => {
                hoverActions.classList.remove('opacity-100', 'visible');
                hoverActions.classList.add('opacity-0', 'invisible');
            });
        });
        
        // Gestion du bouton "Ajouter au panier"
        document.querySelectorAll('.book-card form[action*="panier.ajouter"] button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Empêche le clic de se propager au lien de la carte
                
                // Désactiver le bouton pendant l'envoi
                const originalText = this.innerHTML;
                this.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                this.disabled = true;
                
                // Soumettre le formulaire
                const form = this.closest('form');
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: new URLSearchParams(new FormData(form))
                })
                .then(response => response.json())
                .then(data => {
                    // Réactiver le bouton
                    this.innerHTML = originalText;
                    this.disabled = false;
                    
                    // Afficher un message de succès
                    if (data.success) {
                        // Animation d'ajout
                        this.classList.add('bg-green-500');
                        this.classList.remove('bg-[#FFC62A]', 'hover:bg-[#FFD666]');
                        
                        // Mettre à jour le compteur du panier dans le header
                        updateCartCount(data.cart_count);
                        
                        setTimeout(() => {
                            this.classList.remove('bg-green-500');
                            this.classList.add('bg-[#FFC62A]', 'hover:bg-[#FFD666]');
                        }, 1000);
                        
                        // Notification
                        showNotification('success', data.message || 'Livre ajouté au panier!');
                    } else {
                        showNotification('error', data.message || 'Erreur lors de l\'ajout');
                    }
                })
                .catch(error => {
                    // Réactiver le bouton en cas d'erreur
                    this.innerHTML = originalText;
                    this.disabled = false;
                    showNotification('error', 'Erreur réseau');
                });
            });
        });
        
        // Bouton favoris
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const svg = this.querySelector('svg');
                const card = this.closest('.book-card');
                const title = card.querySelector('h4').textContent;
                
                // Animation coeur
                const isFilled = svg.getAttribute('fill') === 'currentColor';
                if (isFilled) {
                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke', 'currentColor');
                    svg.setAttribute('stroke-width', '2');
                    showNotification('info', `"${title}" retiré des favoris`);
                } else {
                    svg.setAttribute('fill', 'currentColor');
                    svg.removeAttribute('stroke');
                    svg.removeAttribute('stroke-width');
                    showNotification('success', `"${title}" ajouté aux favoris!`);
                }
            });
        });
        
        // Fonction pour mettre à jour le compteur du panier
        function updateCartCount(count) {
            const cartBadge = document.querySelector('header .bg-\\[\\#FFC62A\\]');
            if (cartBadge) {
                cartBadge.textContent = count;
                if (count > 0) {
                    cartBadge.classList.remove('hidden');
                } else {
                    cartBadge.classList.add('hidden');
                }
            }
        }
        
        // Fonction pour afficher les notifications
        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 border border-green-300' :
                type === 'error' ? 'bg-red-100 text-red-800 border border-red-300' :
                'bg-blue-100 text-blue-800 border border-blue-300'
            }`;
            
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        ${type === 'success' ? 
                            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' :
                        type === 'error' ?
                            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>' :
                            '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>'
                        }
                    </svg>
                    <span>${message}</span>
                    <button class="ml-4 text-gray-500 hover:text-gray-700" onclick="this.parentElement.parentElement.remove()">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Auto-remove après 3 secondes
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 3000);
        }
    });
</script>

<style>
    .book-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
    }
    
    .hover-actions {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    @keyframes pulseCategorie {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(255, 198, 42, 0.5);
        border-color: #FFC62A;
    }
    50% {
        box-shadow: 0 0 0 8px rgba(255, 198, 42, 0);
        border-color: #01B3BB;
    }
}

.animate-pulse {
    animation: pulseCategorie 2s infinite;
}
.category-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px -8px rgba(0,0,0,0.12);
}
.category-card {
    transition: all 0.3s ease;
}
.category-card:hover {
    transform: translateY(-6px);
}
</style>

@endsection