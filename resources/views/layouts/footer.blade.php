<footer class="bg-[#01B3BB] text-white mt-16 rounded-tr-[50px] overflow-hidden">
    <div class="container mx-auto px-4 py-12">
        <!-- Main footer content -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12 items-start">
            
            <!-- Logo and social media - Now moved to top left -->
            <div class="lg:col-span-2">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-32 h-32 rounded-full bg-white/10 p-4 flex items-center justify-center">
                            <img src="{{ asset('images/whitelogo.png') }}" alt="Smart Book Hub Logo" class="w-28 h-28 object-contain">
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Smart Book Hub</h2>
                            <p class="text-white/80 text-sm">Votre partenaire de confiance pour l'éducation et la littérature</p>
                        </div>
                    </div>
                    
                    <!-- Social media -->
                    <div>
                        <h4 class="text-lg font-semibold mb-3">Suivez-nous</h4>
                        <div class="flex gap-3">
                            <a href="#" class="w-12 h-12 bg-white/20 hover:bg-[#FFC62A] rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                                <svg class="w-6 h-6 text-white group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/20 hover:bg-[#FFC62A] rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                                <svg class="w-6 h-6 text-white group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/20 hover:bg-[#FFC62A] rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                                <svg class="w-6 h-6 text-white group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick links -->
            <div class="lg:col-span-1">
                <h3 class="text-xl font-bold mb-6 pb-2 border-b border-white/30">Liens rapides</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('apropos') }}" class="flex items-center gap-2 hover:text-[#FFC62A] transition-colors duration-300 group">
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span>A propos</span>
                    </a></li>
                    <li><a href="{{ route('contact') }}" class="flex items-center gap-2 hover:text-[#FFC62A] transition-colors duration-300 group">
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span>Contact</span>
                    </a></li>
                </ul>
            </div>

            <!-- Contact info -->
            <div class="lg:col-span-1">
                <h3 class="text-xl font-bold mb-6 pb-2 border-b border-white/30">Contactez-nous</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 group">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-[#FFC62A] transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block font-medium">Adresse</span>
                            <span class="text-white/90 text-sm">Immeuble Espace Tunis Montplaisir, Tunis</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-[#FFC62A] transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block font-medium">Téléphone</span>
                            <span class="text-white/90 text-sm">71 903 181</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-[#FFC62A] transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block font-medium">Email</span>
                            <span class="text-white/90 text-sm">contact@yeda.com</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Map section -->
            <div class="lg:col-span-1">
                <h3 class="text-xl font-bold mb-6 pb-2 border-b border-white/30">Notre emplacement</h3>
                <div class="relative group">
                    <div id="footer-map" class="rounded-xl overflow-hidden shadow-2xl h-64 w-full transform group-hover:scale-[1.02] transition-transform duration-300 border-2 border-white/20"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#01B3BB]/20 to-transparent rounded-xl pointer-events-none"></div>
                    <p class="text-sm mt-3 text-white/80 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Smart Book Hub, Tunis
                    </p>
                </div>
            </div>
        </div>

        <!-- copyright -->
        <div class="mt-12 pt-6 border-t border-white/20">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/60 text-sm">&copy; {{ date('Y') }} Smart Book Hub. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initializeMap, 500);
});

function initializeMap() {
    const mapElement = document.getElementById('footer-map');
    
    if (!mapElement) {
        console.error('Map container not found');
        return;
    }
    
    mapElement.innerHTML = '';
    
    const companyLatLng = [36.8184854, 10.1870578];
    
    try {
        if (typeof L === 'undefined') {
            console.error('Leaflet library not loaded');
            showStaticMap(mapElement);
            return;
        }
        
        // leaflet map
        const map = L.map('footer-map', {
            center: companyLatLng,
            zoom: 17,
            scrollWheelZoom: false,
            dragging: true,
            zoomControl: false,
            attributionControl: true
        });
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap',
            maxZoom: 19,
        }).addTo(map);
        
        const customIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        
        const marker = L.marker(companyLatLng, {icon: customIcon}).addTo(map);
        marker.bindPopup(`
            <div class="p-2">
                <h3 class="font-bold text-lg text-[#01B3BB]">Smart Book Hub</h3>
                <p class="text-sm">Immeuble Espace Tunis Montplaisir</p>
                <p class="text-sm">Tunis, Tunisie</p>
            </div>
        `);
        
        // map size
        mapElement.style.height = '256px';
        mapElement.style.width = '100%';
        
        setTimeout(() => {
            map.invalidateSize();
            map.setView(companyLatLng, 17);
        }, 300);
        
    } catch (error) {
        console.error('Error initializing map:', error);
        showStaticMap(mapElement);
    }
}

function showStaticMap(mapElement) {
    const companyLatLng = [36.8184854, 10.1870578];
    
    const staticMapUrl = `https://maps.geoapify.com/v1/staticmap?style=osm-bright&width=400&height=256&center=lonlat:${companyLatLng[1]},${companyLatLng[0]}&zoom=17&marker=lonlat:${companyLatLng[1]},${companyLatLng[0]};color:%2301B3BB;size:large&apiKey=b3399cdfbeb44ef78e2d7b05e2a4cfe8`;
    
    mapElement.innerHTML = `
        <a href="https://www.openstreetmap.org/?mlat=${companyLatLng[0]}&mlon=${companyLatLng[1]}#map=17/${companyLatLng[0]}/${companyLatLng[1]}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="block w-full h-full">
            <img src="${staticMapUrl}" 
                 alt="Smart Book Hub Location" 
                 class="w-full h-full object-cover hover:opacity-90 transition duration-300">
        </a>
    `;
}
</script>