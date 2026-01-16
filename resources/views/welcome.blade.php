@extends('layouts.app')

@section('content')
    <!-- hero banner-->
    <section class="relative bg-gradient-to-l from-[#01B3BB] to-[#4ECFD7] overflow-hidden">
        <div class="container mx-auto px-4 py-12">
            <div class="flex items-center justify-between">
                <!-- books image -->
                <div class="w-1/3">
                    <img src="/images/books-collection.png" alt="مجموعة الكتب" class="w-full">
                </div>

                <div class="w-1/3 text-center text-white">
                    <h1 class="text-4xl font-bold mb-4" style="font-family: 'Arial', sans-serif;">إصدارات الأستاذ</h1>
                    <h2 class="text-3xl font-bold mb-4" style="font-family: 'Arial', sans-serif;">طارق البريكي</h2>
                    <p class="text-xl" style="font-family: 'Arial', sans-serif;">رياضيات - إيقاظ </p>
                </div>

                <!-- author image -->
                <div class="w-1/3 relative">
                    <img src="/images/author.png" alt="طارق البريكي" class="w-full">
                </div>
            </div>
        </div>
    </section>

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

                <!-- books -->
                <div class="grid grid-cols-4 gap-6">
                    @if(isset($livres) && count($livres) > 0)
                        @foreach($livres as $livre)
                        <div class="book-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition relative">
                            <div class="relative">
                                <!-- afficher l image du livre si elle existe -->
                                @if($livre->image)
                                    <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-64 object-cover">
                                @else
                                    <!-- Image par défaut -->
                                    <img src="/images/default-book.jpg" alt="{{ $livre->titre }}" class="w-full h-64 object-cover">
                                @endif
                                <div class="hover-actions absolute top-4 left-4 flex gap-2 opacity-0 invisible transition-all duration-300">
                                    <button class="bg-[#FFC62A] text-[#1E1E1E] px-4 py-2 rounded-lg font-semibold hover:bg-[#FFD666] transition">
                                        Ajouter
                                    </button>
                                    <button class="bg-white p-2 rounded-lg hover:bg-gray-100 transition">
                                        <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-[#1E1E1E] mb-2 truncate">{{ $livre->titre }}</h4>
                                <p class="text-[#FFC62A] font-bold text-lg">{{ number_format($livre->prix, 3) }} dt</p>
                                <p class="text-gray-600 text-sm">{{ $livre->auteur }}</p>
                                @if($livre->categorie)
                                    <p class="text-gray-500 text-xs mt-1">{{ $livre->categorie }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- si aucun livre n est trouvé -->
                        <div class="col-span-4 text-center py-8">
                            <p class="text-gray-500">Aucun livre trouvé.</p>
                        </div>
                    @endif
                </div>
            </main>

            <!-- sidebar filter -->
            <aside class="w-64">
                <div class="bg-[#01B3BB] text-white rounded-t-3xl p-6">
                    <h3 class="text-xl font-bold mb-6">Choisir une catégorie</h3>
                    <!-- by category -->
                    <form method="GET" action="{{ url('/') }}" id="categoryForm">
                        @csrf 
                        
                        @if(request()->filled('search'))
                            <input type="hidden" name="search" value="{{ e(request('search')) }}">
                        @endif
                        @if(request()->filled('min_price'))
                            <input type="hidden" name="min_price" value="{{ e(request('min_price')) }}">
                        @endif
                        @if(request()->filled('max_price'))
                            <input type="hidden" name="max_price" value="{{ e(request('max_price')) }}">
                        @endif
                        
                        <select name="categorie" 
                                onchange="this.form.submit()" 
                                class="w-full p-3 rounded-lg text-[#1E1E1E] bg-white border-2 border-gray-200 focus:outline-none focus:border-[#FFC62A]">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories ?? [] as $cat)
                                @if(!empty($cat))
                                    <option value="{{ e($cat) }}" {{ request('categorie') == $cat ? 'selected' : '' }}>
                                        {{ e($cat) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </form>

                    <!-- by price -->
                    <h3 class="text-xl font-bold mt-8 mb-4">Choisir un prix (dt)</h3>
                    <div class="px-2">                        
                        <form method="GET" action="{{ url('/') }}" id="priceForm">
                            @csrf
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
                                    @foreach($plagesPrix ?? [] as $plage)
                                        <button type="submit" name="apply_price_range" value="{{ e($plage['min']) }}_{{ e($plage['max']) }}" class="w-full text-left px-3 py-2 rounded-lg transition 
                                                    {{ request('min_price') == $plage['min'] && request('max_price') == $plage['max'] ? 
                                                        'bg-[#FFC62A] text-[#1E1E1E] font-bold' : 
                                                        'bg-white/10 hover:bg-white/20' }}">
                                            {{ e($plage['label']) }}
                                            <span class="text-xs opacity-75 float-right">({{ e($plage['count']) }})</span>
                                        </button>
                                    @endforeach
                                    
                                    @empty($plagesPrix)
                                        <p class="text-sm text-center opacity-75">Aucune plage de prix disponible</p>
                                    @endempty
                                    
                                </div>
                            </div>
                        </form>
                        
                        <!-- choice of filters -->
                        <div class="mt-6 pt-4 border-t border-white/30">
                            <h4 class="font-bold mb-3">Prix personnalisé:</h4>
                            <form method="GET" action="{{ url('/') }}">
                                @csrf
                                
                                @if(request()->filled('search'))
                                    <input type="hidden" name="search" value="{{ e(request('search')) }}">
                                @endif
                                @if(request()->filled('categorie'))
                                    <input type="hidden" name="categorie" value="{{ e(request('categorie')) }}">
                                @endif
                                
                                <div class="grid grid-cols-2 gap-2 mb-3">
                                    <div>
                                        <label class="block text-sm mb-1">Min (dt)</label>
                                        <input type="number" name="min_price_custom" min="0" max="10000" step="0.5" value="{{ e(request('min_price')) }}" class="w-full p-2 rounded text-[#1E1E1E]">
                                    </div>
                                    <div>
                                        <label class="block text-sm mb-1">Max (dt)</label>
                                        <input type="number" name="max_price_custom" min="0" max="10000" step="0.5" value="{{ e(request('max_price')) }}" class="w-full p-2 rounded text-[#1E1E1E]">
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" 
                                            class="flex-1 bg-[#FFC62A] text-[#1E1E1E] px-3 py-2 rounded font-bold hover:bg-[#FFD666] transition">
                                        Appliquer
                                    </button>
                                    @if(request()->filled('min_price') || request()->filled('max_price'))
                                    <a href="{{ url('/') }}?{{ http_build_query(request()->except(['min_price', 'max_price', 'min_price_custom', 'max_price_custom', 'page'])) }}"
                                    class="flex-1 bg-white/20 text-center px-3 py-2 rounded hover:bg-white/30 transition">
                                        Effacer
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const sliderMin = document.getElementById('slider-min');
        const sliderMax = document.getElementById('slider-max');
        const minValue = document.getElementById('min-value');
        const maxValue = document.getElementById('max-value');
        const sliderTrack = document.getElementById('slider-track');
        const priceRangeButtons = document.querySelectorAll('.price-range-btn');

        function updateSlider() {
            let min = parseInt(sliderMin.value);
            let max = parseInt(sliderMax.value);
            
            const minGap = 20; // marge minimale entre les curseurs
            
            if (max - min < minGap) {
                if (min < sliderMin.max - minGap) {
                    min = max - minGap;
                    sliderMin.value = min;
                } else {
                    max = min + minGap;
                    sliderMax.value = max;
                }
            }
            
            minValue.textContent = `${min} dt`;
            maxValue.textContent = `${max} dt`;
            
            // calcul des pourcentages pour la barre de progression
            const minPercent = ((min - sliderMin.min) / (sliderMin.max - sliderMin.min)) * 100;
            const maxPercent = ((max - sliderMin.min) / (sliderMin.max - sliderMin.min)) * 100;
            
            sliderTrack.style.left = `${minPercent}%`;
            sliderTrack.style.width = `${maxPercent - minPercent}%`;
        }

        sliderMin.addEventListener('input', updateSlider);
        sliderMax.addEventListener('input', updateSlider);
        
        priceRangeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const min = parseInt(this.dataset.min);
                const max = parseInt(this.dataset.max);
                
                sliderMin.value = min;
                sliderMax.value = max;
                
                updateSlider();
                
                priceRangeButtons.forEach(btn => {
                    btn.classList.remove('bg-[#FFC62A]', 'text-[#1E1E1E]');
                    btn.classList.add('bg-white/10', 'hover:bg-white/20');
                });
                
                this.classList.remove('bg-white/10', 'hover:bg-white/20');
                this.classList.add('bg-[#FFC62A]', 'text-[#1E1E1E]');
            });
        });

        updateSlider();
        
        if (priceRangeButtons.length > 0) {
            priceRangeButtons[1].classList.remove('bg-white/10', 'hover:bg-white/20');
            priceRangeButtons[1].classList.add('bg-[#FFC62A]', 'text-[#1E1E1E]');
        }
    </script>
@endsection