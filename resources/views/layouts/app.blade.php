<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Book Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    
    <!-- scripts -->
    @yield('scripts')
</body>
</html>