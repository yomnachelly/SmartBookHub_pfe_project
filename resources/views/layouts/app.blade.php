<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Book Hub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white font-sans text-left">

@include('layouts.header')

<main>
    @yield('content')
</main>

@include('layouts.footer')

{{-- ==================== AVATAR FLOTTANT ==================== --}}
<div id="chatbot-avatar" style="
    position: fixed;
    bottom: 5px;
    right: 5px;
    width: 160px;
    height: 160px;
    cursor: pointer;
    z-index: 1000;
    transition: opacity 0.3s ease, transform 0.3s ease;
">
    <a href="#" onclick="openChatPanel(); return false;">
        <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.11/dist/dotlottie-wc.js" type="module"></script>
        <dotlottie-wc
            src="https://lottie.host/7cfe3311-ea7f-4300-8eff-367d580407df/yUSQESJbVG.lottie"
            style="width: 100%; height: 100%;"
            autoplay
            loop>
        </dotlottie-wc>
    </a>
</div>

{{-- ==================== CHAT PANEL ==================== --}}
<div id="chatbot-panel" style="
    position: fixed;
    top: 0;
    right: 0;
    width: 0;
    height: 100vh;
    z-index: 999;
    display: flex;
    transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: visible;
    pointer-events: none;
">

    {{-- Resize handle --}}
    <div id="chatbot-resize-handle" style="
        width: 5px;
        height: 100%;
        cursor: col-resize;
        background: transparent;
        flex-shrink: 0;
        position: relative;
        z-index: 1001;
        pointer-events: none;
        transition: background 0.2s;
    ">
        <div style="
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 5px;
            height: 60px;
            background: #01B3BB;
            border-radius: 3px;
            opacity: 0.7;
        "></div>
    </div>

    {{-- Panel content --}}
    <div id="chatbot-panel-content" style="
        flex: 1;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        border-left: 1px solid #e5e7eb;
        box-shadow: -4px 0 24px rgba(0,0,0,0.12);
        overflow: hidden;
        pointer-events: all;
        min-width: 0;
    ">

        {{-- Header --}}
        <div style="
            background: linear-gradient(135deg, #01B3BB, #2ac8d0);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        ">
            <div style="color: white; font-weight: 700; font-size: 15px; font-family: sans-serif;">Assistant IA</div>
            <button onclick="closeChatPanel()" style="
                background: rgba(255,255,255,0.15);
                border: none;
                width: 34px;
                height: 34px;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            ">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
        </div>

        {{-- Messages --}}
        <div id="chatbot-messages" style="
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            background: #f8fafc;
            font-family: sans-serif;
        ">
            <div style="display: flex; gap: 10px; align-items: flex-start;">
                <div style="
                    width: 32px;
                    height: 32px;
                    background: linear-gradient(135deg, #01B3BB, #2ac8d0);
                    border-radius: 50%;
                    flex-shrink: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                    </svg>
                </div>
                <div style="
                    background: white;
                    border-radius: 0 16px 16px 16px;
                    padding: 12px 16px;
                    max-width: 80%;
                    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
                    font-size: 14px;
                    color: #374151;
                    line-height: 1.5;
                ">
                    Bonjour ! 👋 Je suis votre assistant. Comment puis-je vous aider aujourd'hui ?
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div style="
            padding: 16px 20px;
            background: white;
            border-top: 1px solid #e5e7eb;
            flex-shrink: 0;
        ">
            <div style="display:flex; gap:10px; align-items:flex-end; background:#f1f5f9; border-radius:24px; padding:8px 16px; border:1px solid #e2e8f0;" id="input-wrapper">
                <textarea id="chatbot-input" placeholder="Tapez votre message..." rows="1" style="flex:1; border:none; background:transparent; outline:none; resize:none; font-size:14px; color:#374151; font-family:sans-serif; line-height:1.5; max-height:120px; overflow-y:auto; padding:4px 0;" onkeydown="handleChatKeydown(event)" oninput="autoResizeTextarea(this)"></textarea>
                <button onclick="sendChatMessage()" id="send-btn" style="width:38px; height:38px; background:linear-gradient(135deg,#01B3BB,#2ac8d0); border:none; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ==================== SCRIPT ==================== --}}
<script>
let chatPanelOpen = false;
let panelWidth = Math.max(window.innerWidth * 0.3, 280); // 30% de l'écran ou minimum 280px
let isResizing = false;
let startX = 0;
let startWidth = 0;

const panel = document.getElementById('chatbot-panel');
const avatar = document.getElementById('chatbot-avatar');
const handle = document.getElementById('chatbot-resize-handle');
const messages = document.getElementById('chatbot-messages');

function openChatPanel() {
    chatPanelOpen = true;
    panel.style.width = panelWidth + 'px';
    panel.style.pointerEvents = 'all';
    handle.style.pointerEvents = 'all';
    avatar.style.opacity = '0';
    avatar.style.transform = 'scale(0.5)';
    setTimeout(() => { avatar.style.display = 'none'; }, 300);
}

function closeChatPanel() {
    chatPanelOpen = false;
    panel.style.width = '0';
    panel.style.pointerEvents = 'none';
    handle.style.pointerEvents = 'none';
    avatar.style.display = 'block';
    setTimeout(() => { avatar.style.opacity = '1'; avatar.style.transform = 'scale(1)'; }, 50);
}

handle.addEventListener('mousedown', (e) => {
    isResizing = true;
    startX = e.clientX;
    startWidth = panel.offsetWidth;
    document.body.style.cursor = 'col-resize';
    document.body.style.userSelect = 'none';
    panel.style.transition = 'none';
    e.preventDefault();
});

document.addEventListener('mousemove', (e) => {
    if (!isResizing) return;
    const delta = startX - e.clientX;
    const newWidth = Math.min(Math.max(startWidth + delta, 280), window.innerWidth * 0.85);
    panelWidth = newWidth;
    panel.style.width = newWidth + 'px';
});

document.addEventListener('mouseup', () => {
    if (!isResizing) return;
    isResizing = false;
    document.body.style.cursor = '';
    document.body.style.userSelect = '';
    panel.style.transition = 'width 0.35s cubic-bezier(0.4,0,0.2,1)';
});

function autoResizeTextarea(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 120) + 'px';
}

function handleChatKeydown(e) {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendChatMessage(); }
}

function addMessage(text, isUser) {
    const wrapper = document.createElement('div');
    wrapper.style.cssText = `display:flex;gap:10px;align-items:flex-start;justify-content:${isUser?'flex-end':'flex-start'};`;

    const bubble = document.createElement('div');
    bubble.style.cssText = `
        max-width: 80%;
        padding: 12px 16px;
        border-radius: ${isUser?'16px 16px 0 16px':'0 16px 16px 16px'};
        background: ${isUser?'linear-gradient(135deg,#01B3BB,#2ac8d0)':'white'};
        color: ${isUser?'white':'#374151'};
        font-size: 14px;
        line-height: 1.5;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        font-family: sans-serif;
        word-wrap: break-word;
    `;
    bubble.textContent = text;
    wrapper.appendChild(bubble);
    messages.appendChild(wrapper);
    messages.scrollTop = messages.scrollHeight;
}

// ⚡ Ici tu peux connecter à FastAPI
async function sendChatMessage() {
    const input = document.getElementById('chatbot-input');
    const text = input.value.trim();
    if(!text) return;

    addMessage(text, true);
    input.value = '';
    input.style.height = 'auto';

    try {
        // Changement important : utilise l'URL complète de ton Laravel
        const response = await fetch('/api/chatbot/ask', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({ prompt: text })
        });
        
        const data = await response.json();
       addMessage(data.answer ?? 'Pas de réponse', false);
    } catch(err) {
        console.error('Erreur:', err);
        addMessage('Erreur de connexion au backend', false);
    }
}
</script>


</body>
</html>