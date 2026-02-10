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
    @include('components.chatbot-avatar')
<div id="chatbot-window" style="
    position: fixed;
    left: -400px;       /* cacher complètement avant clic */
    bottom: 20px;
    width: 350px;       /* largeur du chat */
    height: 500px;      /* hauteur du chat */
    background: #40E0D0; 
    border: 2px solid #40E0D0; 
    border-radius: 10px;
    box-shadow: 2px 2px 15px rgba(0,0,0,0.2);
    transition: left 0.3s;
    z-index: 999;
    display: flex;
    flex-direction: column;
    overflow: hidden;
">
    <!-- Header -->
    <div style="background:#20B2AA; color:white; padding:10px; text-align:center;">
        Chatbot
    </div>

    <!-- Messages -->
    <div id="chatbot-messages" style="
        flex: 1;
        padding: 10px;
        overflow-y: auto;
        font-size: 14px;
        background: #E0FFFF;
    "></div>

    <!-- Input -->
    <div style="padding: 5px; border-top: 1px solid #ccc; display:flex;">
        <input type="text" id="chatbot-input" placeholder="Écris un message..." style="flex:1; padding:5px; border-radius:5px; border:1px solid #ccc;">
        <button id="chatbot-send" style="margin-left:5px; background:#20B2AA; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
            Envoyer
        </button>
    </div>
</div>

<div id="chatbot-window" style="
    position: fixed;
    left: -360px;       /* cachée par défaut */
    bottom: 20px;
    width: 350px;       /* largeur plus grande */
    height: 500px;      /* hauteur plus grande */
    background: #40E0D0; /* turquoise clair pour le fond */
    border: 2px solid #40E0D0; /* turquoise pour la bordure */
    border-radius: 10px;
    box-shadow: 2px 2px 15px rgba(0,0,0,0.2);
    transition: left 0.3s;
    z-index: 999;
    display: flex;
    flex-direction: column;
    overflow: hidden;
">
    <!-- Header -->
    <div style="background:#20B2AA; color:white; padding:10px; text-align:center;">
        Chatbot
    </div>

    <!-- Messages -->
    <div id="chatbot-messages" style="
        flex: 1;
        padding: 10px;
        overflow-y: auto;
        font-size: 14px;
        background: #E0FFFF; /* légèrement plus clair pour les messages */
    "></div>

    <!-- Input -->
    <div style="padding: 5px; border-top: 1px solid #ccc; display:flex;">
        <input type="text" id="chatbot-input" placeholder="Écris un message..." style="flex:1; padding:5px; border-radius:5px; border:1px solid #ccc;">
        <button id="chatbot-send" style="margin-left:5px; background:#20B2AA; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
            Envoyer
        </button>
    </div>
</div>


    <!-- Input -->
    <div style="padding: 5px; border-top: 1px solid #ddd; display:flex;">
        <input type="text" id="chatbot-input" placeholder="Écris un message..." style="flex:1; padding:5px; border-radius:5px; border:1px solid #ccc;">
        <button id="chatbot-send" style="margin-left:5px; background:#4CAF50; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
            Envoyer
        </button>
    </div>
</div>
<script>
    const avatar = document.getElementById('chatbot-avatar');
    const chatWindow = document.getElementById('chatbot-window');
    const sendBtn = document.getElementById('chatbot-send');
    const input = document.getElementById('chatbot-input');
    const messages = document.getElementById('chatbot-messages');

    // Ouvrir / fermer le chat
    avatar.addEventListener('click', () => {
        chatWindow.style.left = chatWindow.style.left === '20px' ? '-320px' : '20px';
    });

    // Ajouter un message front
    function addMessage(text, from = 'user'){
        const div = document.createElement('div');
        div.textContent = text;
        div.style.margin = '5px 0';
        div.style.padding = '5px 10px';
        div.style.borderRadius = '10px';
        div.style.maxWidth = '80%';
        div.style.wordWrap = 'break-word';
        if(from === 'user'){
            div.style.background = '#DCF8C6';
            div.style.alignSelf = 'flex-end';
        } else {
            div.style.background = '#F1F0F0';
            div.style.alignSelf = 'flex-start';
        }
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    // Envoyer message
    sendBtn.addEventListener('click', () => {
        const text = input.value.trim();
        if(!text) return;
        addMessage(text, 'user');
        input.value = '';
        // Simuler réponse bot
        setTimeout(() => {
            addMessage("Réponse du chatbot (demo)", 'bot');
        }, 800);
    });

    // Enter pour envoyer
    input.addEventListener('keypress', (e) => {
        if(e.key === 'Enter') sendBtn.click();
    });
</script>


</body>
</html>