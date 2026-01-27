<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Book Hub</title>
    
    <!-- Leaflet CSS (for maps) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .book-card:hover .hover-actions {
            opacity: 1;
            visibility: visible;
        }
        
        .range-slider {
            position: relative;
            height: 8px;
            background: white;
            border-radius: 4px;
        }
        
        .range-slider input[type="range"] {
            position: absolute;
            width: 100%;
            height: 8px;
            background: transparent;
            pointer-events: none;
            -webkit-appearance: none;
        }
        
        .range-slider input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            pointer-events: all;
            width: 20px;
            height: 20px;
            background: #FFC62A;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
        }
        
        .range-slider input[type="range"]::-moz-range-thumb {
            pointer-events: all;
            width: 20px;
            height: 20px;
            background: #FFC62A;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
        }
        
        .range-slider-track {
            position: absolute;
            height: 8px;
            background: #FFC62A;
            border-radius: 4px;
            pointer-events: none;
        }
        
        /* Dropdown styling */
        .dropdown-content {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }
        
        .group:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        /* Map styling */
        #footer-map {
            border-radius: 12px;
            overflow: hidden;
            min-height: 200px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-white font-sans text-left">
    <!-- header -->
    @include('layouts.header')
    
    <!-- main content -->
    <main>
        @yield('content')
    </main>
    
    <!-- footer -->
    @include('layouts.footer')
    
    <!-- Leaflet JS (for maps) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    
    <!-- scripts -->
    @yield('scripts')
</body>
</html>