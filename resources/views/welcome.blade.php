@extends('layouts.app')

@section('content')
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if(isset($livres) && count($livres) > 0)
                        @foreach($livres as $livre)
                        <div class="book-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition relative group cursor-pointer">
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
                                <div class="hover-actions absolute top-4 left-4 flex gap-2 opacity-0 invisible transition-all duration-300">
                                    <button class="bg-[#FFC62A] text-[#1E1E1E] px-4 py-2 rounded-lg font-semibold hover:bg-[#FFD666] transition z-20 relative">
                                        Ajouter
                                    </button>
                                    <button class="bg-white p-2 rounded-lg hover:bg-gray-100 transition z-20 relative">
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
                        
                        <select name="categorie" 
                                onchange="this.form.submit()" 
                                class="w-full p-3 rounded-lg text-[#1E1E1E] bg-white border-2 border-gray-200 focus:outline-none focus:border-[#FFC62A]">
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
                </div>
            </aside>
        </div>
    </div>
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
        
        document.querySelectorAll('.book-card .bg-\\[\\#FFC62A\\]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const card = this.closest('.book-card');
                const title = card.querySelector('h4').textContent;
                const price = card.querySelector('.text-lg').textContent;
                
                alert(`"${title}" ajouté au panier!\nPrix: ${price}`);
            });
        });
        
        // wishlist btn
        document.querySelectorAll('.book-card .bg-white').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const svg = this.querySelector('svg');
                const card = this.closest('.book-card');
                const title = card.querySelector('h4').textContent;
                
                // heart fill
                const isFilled = svg.getAttribute('fill') === 'currentColor';
                if (isFilled) {
                    svg.setAttribute('fill', 'none');
                    svg.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>';
                    alert(`"${title}" retiré des favoris`);
                } else {
                    svg.setAttribute('fill', 'currentColor');
                    svg.innerHTML = '<path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>';
                    alert(`"${title}" ajouté aux favoris!`);
                }
            });
        });
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
</style>
@endsection