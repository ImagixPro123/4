<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>ImagixPro — Ultra Premium Studio</title>
    
    <!-- New Browser Favicon Integration -->
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="favicon.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Premium Luxury Dark Palette */
            --bg-base: #030407;
            --bg-surface: #0a0d14;
            --bg-panel: rgba(15, 20, 30, 0.7);
            --text-primary: #ffffff;
            --text-secondary: #8a94a6;
            --border-light: rgba(255, 255, 255, 0.08);
            --border-focus: rgba(212, 175, 55, 0.6);
            --accent-gradient: linear-gradient(135deg, #d4af37 0%, #f3e5ab 100%);
            --accent-hover: linear-gradient(135deg, #c5a028 0%, #e8d58a 100%);
            --sidebar-width: 340px;
            --glass-blur: blur(25px);
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: var(--bg-base); color: var(--text-primary);
            overflow: hidden; height: 100dvh; display: flex;
            background-image: radial-gradient(circle at 20% 40%, rgba(212, 175, 55, 0.04), transparent 30%),
                              radial-gradient(circle at 80% 60%, rgba(99, 102, 241, 0.04), transparent 30%);
            user-select: none; -webkit-user-select: none;
        }

        img { -webkit-touch-callout: none; pointer-events: none; }
        textarea { user-select: text; -webkit-user-select: text; }

        .app-layout { display: flex; width: 100%; height: 100%; }

        /* ----- Sidebar ----- */
        .sidebar {
            width: var(--sidebar-width); background-color: var(--bg-surface);
            border-right: 1px solid var(--border-light);
            display: flex; flex-direction: column;
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            z-index: 100;
        }
        .sidebar-header {
            padding: 1.5rem; border-bottom: 1px solid var(--border-light);
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(10, 13, 20, 0.85); backdrop-filter: var(--glass-blur);
        }
        
        /* Logo Styles */
        .brand {
            font-size: 1.4rem; font-weight: 800;
            background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            display: flex; align-items: center; gap: 10px; letter-spacing: -0.5px;
        }
        .brand-logo {
            width: 32px; height: 32px; border-radius: 50%;
            object-fit: cover; box-shadow: 0 2px 10px rgba(0,0,0,0.5);
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .sidebar-content { flex: 1; overflow-y: auto; padding: 1.5rem; scroll-behavior: smooth; }
        .sidebar-content::-webkit-scrollbar { width: 4px; }
        .sidebar-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        
        .free-notice {
            background: rgba(255, 255, 255, 0.04); border: 1px solid var(--border-light);
            padding: 12px 14px; border-radius: 12px; font-size: 0.75rem; color: var(--text-secondary);
            text-align: left; line-height: 1.5; font-weight: 500; margin-bottom: 1.5rem;
        }
        .free-notice i { color: #d4af37; margin-right: 5px; }
        
        .section-title { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; color: var(--text-secondary); font-weight: 600; margin-bottom: 1.2rem; }

        /* History Grid */
        .history-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .img-wrapper {
            position: relative; border-radius: 14px; overflow: hidden;
            border: 1px solid var(--border-light); background: #0d111a;
            aspect-ratio: 1; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .img-wrapper:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.5), 0 0 0 1px rgba(212, 175, 55, 0.3); }
        .base-img { width: 100%; height: 100%; object-fit: cover; }
        .visual-watermark {
            position: absolute; bottom: 6%; right: 6%; color: rgba(255, 255, 255, 0.7);
            font-weight: 700; font-size: clamp(8px, 2.5cqw, 11px); text-shadow: 0 1px 3px rgba(0,0,0,0.9);
            pointer-events: none; text-align: right;
        }

        /* ----- Main Workspace ----- */
        .main-workspace { flex: 1; display: flex; flex-direction: column; position: relative; }
        
        .top-navbar {
            height: 70px; display: flex; align-items: center; padding: 0 2rem;
            justify-content: space-between; border-bottom: 1px solid var(--border-light);
            background: rgba(3, 4, 7, 0.75); backdrop-filter: var(--glass-blur);
            z-index: 10; flex-shrink: 0;
        }
        .menu-toggle { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }
        .pro-badge {
            font-size: 0.75rem; color: #d4af37; background: rgba(212, 175, 55, 0.1);
            padding: 6px 14px; border-radius: 30px; border: 1px solid rgba(212, 175, 55, 0.2); font-weight: 700;
        }

        .scrollable-canvas {
            flex: 1; overflow-y: auto; display: flex; justify-content: center; align-items: center;
            padding: 2rem; position: relative;
        }

        .image-preview-card {
            background: var(--bg-panel); backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-light); border-radius: 24px; padding: 1.5rem;
            box-shadow: 0 30px 60px -15px rgba(0,0,0,0.8);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            width: 100%; max-width: 600px; min-height: 450px; margin: auto; position: relative;
        }

        /* ----- UI States Inside Preview Card ----- */
        .ui-state {
            display: none; flex-direction: column; align-items: center; justify-content: center;
            width: 100%; height: 100%; text-align: center; animation: fadeIn 0.4s ease;
        }
        .ui-state.active-state { display: flex; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }

        /* Welcome State */
        .welcome-logo {
            width: 100px; height: 100px; border-radius: 50%;
            object-fit: cover; margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 0 2px rgba(212, 175, 55, 0.3);
        }
        #welcomeState h2 { font-weight: 800; font-size: 2rem; margin-bottom: 10px; letter-spacing: -0.5px; }
        #welcomeState p { color: var(--text-secondary); font-size: 1rem; }

        /* Loading State */
        .luxury-loader {
            width: 60px; height: 60px; border: 3px solid rgba(212, 175, 55, 0.15);
            border-top-color: #d4af37; border-radius: 50%; animation: spin 1s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            margin-bottom: 20px;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* Result State */
        .main-img-wrapper {
            position: relative; border-radius: 16px; overflow: hidden;
            cursor: pointer; box-shadow: 0 10px 40px rgba(0,0,0,0.6);
            width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;
        }
        .main-img { max-width: 100%; max-height: 55vh; object-fit: contain; border-radius: 12px; }
        .main-watermark {
            position: absolute; bottom: 15px; right: 15px; color: rgba(255, 255, 255, 0.75);
            font-weight: 700; font-size: 0.85rem; text-shadow: 0 2px 6px rgba(0,0,0,0.9); pointer-events: none;
            text-align: right;
        }

        /* ----- Prompt Dock ----- */
        .prompt-dock {
            background: rgba(10, 13, 20, 0.85); backdrop-filter: var(--glass-blur);
            border-top: 1px solid var(--border-light); padding: 1.2rem 2rem;
            display: flex; flex-direction: column; gap: 1rem; z-index: 10;
            padding-bottom: calc(0.8rem + env(safe-area-inset-bottom));
        }
        
        .settings-row { display: flex; justify-content: flex-end; align-items: center; margin-bottom: -5px; }

        .prompt-input-wrapper {
            display: flex; gap: 12px; background: rgba(0,0,0,0.4);
            border: 1px solid var(--border-light); border-radius: 18px; padding: 6px; transition: all 0.3s;
        }
        .prompt-input-wrapper:focus-within { border-color: var(--border-focus); box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1); }
        .prompt-textarea {
            flex: 1; background: transparent; border: none; color: white; padding: 14px 16px;
            font-size: 0.95rem; resize: none; outline: none; min-height: 52px; max-height: 120px; line-height: 1.5;
        }
        .prompt-textarea::placeholder { color: #556075; font-weight: 400; }
        
        .generate-btn {
            background: var(--accent-gradient); color: #000; border: none; border-radius: 14px;
            padding: 0 24px; font-weight: 800; font-size: 0.95rem; cursor: pointer;
            display: flex; align-items: center; gap: 8px; transition: all 0.2s ease;
        }
        .generate-btn:hover:not(:disabled) { transform: translateY(-2px); background: var(--accent-hover); box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3); }
        .generate-btn:disabled { background: #2a2e38; color: #556075; cursor: not-allowed; transform: none; box-shadow: none; }
        .generate-btn.cooldown-btn { background: #1f232e; color: #d4af37; border: 1px solid rgba(212, 175, 55, 0.3); }

        /* ----- Full Screen Modal ----- */
        .fs-modal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.95); backdrop-filter: blur(25px);
            z-index: 1000; display: flex; flex-direction: column;
            opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
        }
        .fs-modal.active { opacity: 1; pointer-events: auto; }
        .fs-header { padding: 20px; text-align: right; background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent); }
        .fs-close { background: none; border: none; color: white; font-size: 2rem; cursor: pointer; padding: 10px; }
        
        .fs-body { flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px; overflow: hidden; }
        .fs-img-container {
            position: relative; max-width: 95%; max-height: 85vh;
            box-shadow: 0 0 50px rgba(0,0,0,0.8); border-radius: 12px; overflow: hidden; cursor: pointer;
        }
        .fs-img-container img { width: 100%; height: 100%; object-fit: contain; }
        
        .fs-footer {
            padding: 20px; padding-bottom: calc(20px + env(safe-area-inset-bottom));
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;
        }
        .luxury-btn {
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
            color: white; padding: 12px 24px; border-radius: 30px; font-weight: 700;
            cursor: pointer; display: flex; align-items: center; gap: 8px; backdrop-filter: blur(10px);
        }
        .luxury-btn:hover { background: rgba(255,255,255,0.15); transform: translateY(-2px); }
        .luxury-btn.primary { background: var(--accent-gradient); color: black; border: none; }

        /* ----- Dual Download Options Modal (1K vs 2K) ----- */
        .download-modal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px);
            z-index: 2000; display: flex; justify-content: center; align-items: center;
            opacity: 0; pointer-events: none; transition: opacity 0.2s;
        }
        .download-modal.active { opacity: 1; pointer-events: auto; }
        .dl-content {
            background: #111520; border: 1px solid var(--border-focus);
            padding: 30px; border-radius: 24px; text-align: center; width: 90%; max-width: 350px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.9), 0 0 20px rgba(212, 175, 55, 0.2);
            transform: scale(0.9); transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .download-modal.active .dl-content { transform: scale(1); }
        .dl-icon { font-size: 3rem; color: #d4af37; margin-bottom: 15px; }
        
        .dl-options { display: flex; flex-direction: column; gap: 12px; margin-top: 20px; }
        .dl-btn {
            padding: 14px; border-radius: 12px; font-weight: 800; font-size: 1rem; cursor: pointer;
            display: flex; justify-content: center; align-items: center; gap: 8px; transition: all 0.2s;
        }
        .dl-btn-2k { background: var(--accent-gradient); color: black; border: none; }
        .dl-btn-2k:hover { box-shadow: 0 0 15px rgba(212, 175, 55, 0.5); transform: scale(1.02); }
        .dl-btn-1k { background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); }
        .dl-cancel { margin-top: 15px; color: var(--text-secondary); text-decoration: underline; cursor: pointer; font-size: 0.85rem; }

        /* ----- Toast ----- */
        .toast {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%) translateY(-20px);
            background: rgba(15, 20, 30, 0.95); border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(15px); box-shadow: 0 15px 35px rgba(0,0,0,0.6);
            padding: 12px 28px; border-radius: 40px; z-index: 9999;
            opacity: 0; transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            font-weight: 600; display: flex; align-items: center; gap: 10px; font-size: 0.9rem;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        /* ----- Anti-Screenshot ----- */
        .screenshot-protector { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: black; z-index: 99999; pointer-events: none; opacity: 0; }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar { position: fixed; left: -100%; top: 0; height: 100%; box-shadow: 15px 0 40px rgba(0,0,0,0.7); }
            .sidebar.open { left: 0; transform: translateX(0); }
            .menu-toggle { display: block; }
            .top-navbar { padding: 0 1.2rem; }
            .image-preview-card { padding: 1rem; min-height: 350px; border-radius: 18px; }
            .prompt-dock { padding: 1rem; border-top-left-radius: 24px; border-top-right-radius: 24px; box-shadow: 0 -10px 30px rgba(0,0,0,0.5); }
            .prompt-input-wrapper { flex-direction: column; background: transparent; border: none; padding: 0; gap: 10px; }
            .prompt-textarea { background: rgba(255,255,255,0.05); border-radius: 14px; border: 1px solid var(--border-light); padding: 12px; }
            .generate-btn { padding: 14px; justify-content: center; width: 100%; border-radius: 14px; }
            .settings-row { justify-content: center; margin-bottom: 10px; }
        }
        .sidebar-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 99; display: none; opacity: 0; transition: opacity 0.3s;
        }
        .sidebar-overlay.show { display: block; opacity: 1; }
        .close-sidebar { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }
        @media (max-width: 900px) { .close-sidebar { display: block; } }

    </style>
</head>
<body>

<div id="screenshotProtector" class="screenshot-protector"></div>

<div class="app-layout">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="brand">
                <img src="logo.png" alt="Logo" class="brand-logo"> 
                ImagixPro
            </div>
            <button class="close-sidebar" id="closeSidebar"><i class="fas fa-times"></i></button>
        </div>
        <div class="sidebar-content">
            
            <div class="free-notice">
                <i class="fas fa-info-circle"></i> For now, image generation is completely free and unlimited. However, this may change in the future, and some features could require a paid plan later on.
            </div>

            <div class="section-title">Studio Gallery</div>
            <div id="historyList" class="history-grid"></div>
            <div id="emptyHistory" style="text-align: center; color: var(--text-secondary); margin-top: 3rem; font-size: 0.85rem;">
                <i class="fas fa-images" style="font-size: 2.5rem; margin-bottom: 12px; opacity: 0.3;"></i><br>
                Masterpieces appear here
            </div>
        </div>
    </aside>

    <main class="main-workspace">
        <header class="top-navbar">
            <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
            <div style="flex: 1; text-align: right;">
                <span class="pro-badge"><i class="fas fa-bolt"></i> IMAGIXPRO ENGINE</span>
            </div>
        </header>

        <div class="scrollable-canvas">
            <div class="image-preview-card">
                
                <!-- State 1: App Welcome Home -->
                <div id="welcomeState" class="ui-state active-state">
                    <img src="logo.png" alt="ImagixPro Logo" class="welcome-logo">
                    <h2>ImagixPro</h2>
                    <p>Describe your vision to begin creating</p>
                </div>

                <!-- State 2: Generating / Loading -->
                <div id="loadingState" class="ui-state">
                    <div class="luxury-loader"></div>
                    <p id="statusMessage" style="font-weight: 600; font-size: 1.1rem;">Igniting ImagixPro Engines...</p>
                </div>
                
                <!-- State 3: Final Generated Image Result -->
                <div id="resultState" class="ui-state">
                    <div class="main-img-wrapper interactable-img" data-url="" data-prompt="" id="mainWrapperNode">
                        <img id="outputImage" class="main-img" src="" alt="Artwork">
                        <!-- Small Bottom-Right Watermark -->
                        <div class="main-watermark">ImagixPro</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="prompt-dock">
            
            <div class="settings-row">
                <span style="color: var(--text-secondary); font-size: 0.75rem; font-weight: 500;">
                    Tip: Use <code style="color: #d4af37;">--no</code> to avoid things (e.g. <i>--no blur, ugly</i>)
                </span>
            </div>

            <div class="prompt-input-wrapper">
                <textarea id="promptInput" class="prompt-textarea" placeholder="Describe your masterpiece... (e.g. Cinematic futuristic sports car racing in neon city)"></textarea>
                <button id="generateBtn" class="generate-btn"><i class="fas fa-wand-magic-sparkles"></i> Generate</button>
            </div>
        </div>
    </main>
</div>

<!-- Full Screen Modal -->
<div class="fs-modal" id="fsModal">
    <div class="fs-header">
        <button class="fs-close" id="fsClose"><i class="fas fa-times"></i></button>
    </div>
    <div class="fs-body">
        <div class="fs-img-container interactable-img" id="fsImgWrapper" data-url="" data-prompt="">
            <img id="fsImage" src="" alt="Fullscreen">
            <div class="main-watermark" style="bottom: 20px; right: 20px; font-size: 1.2rem;">ImagixPro</div>
        </div>
    </div>
    <div class="fs-footer">
        <button class="luxury-btn primary" id="fsDownloadTrigger"><i class="fas fa-download"></i> Save Masterpiece</button>
        <button class="luxury-btn" id="fsCopy"><i class="fas fa-copy"></i> Copy Prompt</button>
    </div>
</div>

<!-- Dual Download Modal (1K / 2K) -->
<div class="download-modal" id="dlModal">
    <div class="dl-content">
        <i class="fas fa-cloud-arrow-down dl-icon"></i>
        <h3 style="margin-bottom: 8px; font-weight: 800; font-size: 1.4rem;">Download Quality</h3>
        <p style="font-size: 0.9rem; color: var(--text-secondary);">Select the resolution for your masterpiece.</p>
        
        <div class="dl-options">
            <button class="dl-btn dl-btn-2k" id="btn2k"><i class="fas fa-gem"></i> 2K Ultra (Upscaled)</button>
            <button class="dl-btn dl-btn-1k" id="btn1k"><i class="fas fa-image"></i> 1K Original</button>
        </div>
        <div class="dl-cancel" id="dlCancel">Cancel</div>
    </div>
</div>

<script>
    const promptInput = document.getElementById('promptInput');
    const generateBtn = document.getElementById('generateBtn');
    
    // UI States Elements
    const welcomeState = document.getElementById('welcomeState');
    const loadingState = document.getElementById('loadingState');
    const resultState = document.getElementById('resultState');
    const statusMsg = document.getElementById('statusMessage');
    const outputImage = document.getElementById('outputImage');
    const mainWrapperNode = document.getElementById('mainWrapperNode');

    const historyContainer = document.getElementById('historyList');
    const emptyHistory = document.getElementById('emptyHistory');
    
    // Sidebar
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Full Screen
    const fsModal = document.getElementById('fsModal');
    const fsImage = document.getElementById('fsImage');
    const fsImgWrapper = document.getElementById('fsImgWrapper');
    const fsClose = document.getElementById('fsClose');
    const fsDownloadTrigger = document.getElementById('fsDownloadTrigger');
    const fsCopy = document.getElementById('fsCopy');

    // Download Modal
    const dlModal = document.getElementById('dlModal');
    const btn2k = document.getElementById('btn2k');
    const btn1k = document.getElementById('btn1k');
    const dlCancel = document.getElementById('dlCancel');

    let dlTargetUrl = '';
    let dlTargetPrompt = '';
    let history = [];
    let canGenerate = true;
    let cooldownTimer = null;

    // UI State Manager
    function switchUIState(state) {
        welcomeState.classList.remove('active-state');
        loadingState.classList.remove('active-state');
        resultState.classList.remove('active-state');
        
        if(state === 'welcome') welcomeState.classList.add('active-state');
        if(state === 'loading') loadingState.classList.add('active-state');
        if(state === 'result') resultState.classList.add('active-state');
    }

    // Auto-resize textarea
    promptInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // ----- History System -----
    function loadHistoryFromStorage() {
        const stored = localStorage.getItem('imagixpro_history');
        if(stored) { try { history = JSON.parse(stored); } catch(e) { history = []; } }
        renderHistory();
    }
    function saveHistoryToStorage() { 
        localStorage.setItem('imagixpro_history', JSON.stringify(history.slice(0, 40))); 
        renderHistory(); 
    }
    function addToHistory(imageUrl, prompt) {
        history.unshift({ id: Date.now(), imageUrl, prompt });
        saveHistoryToStorage();
    }

    function renderHistory() {
        if(history.length === 0) { 
            historyContainer.innerHTML = '';
            emptyHistory.style.display = 'block';
            return; 
        }
        emptyHistory.style.display = 'none';
        let html = '';
        history.forEach(item => {
            let safePrompt = item.prompt.replace(/"/g, '&quot;');
            html += `
                <div class="img-wrapper interactable-img" data-url="${item.imageUrl}" data-prompt="${safePrompt}">
                    <img src="${item.imageUrl}" alt="history" class="base-img">
                    <div class="visual-watermark">ImagixPro</div>
                </div>
            `;
        });
        historyContainer.innerHTML = html;
    }

    // ----- Advanced Download System (1K & 2K) with Bottom-Right Watermark -----
    function openDownloadModal(url, prompt) {
        dlTargetUrl = url;
        dlTargetPrompt = prompt;
        dlModal.classList.add('active');
    }
    dlCancel.onclick = () => dlModal.classList.remove('active');
    btn1k.onclick = () => { dlModal.classList.remove('active'); processDownload(dlTargetUrl, 1); };
    btn2k.onclick = () => { dlModal.classList.remove('active'); processDownload(dlTargetUrl, 2); };

    async function processDownload(imageUrl, scaleFactor) {
        try {
            showToast(scaleFactor === 2 ? "Upscaling to 2K Ultra Quality..." : "Preparing 1K Original...");
            const img = new Image();
            img.crossOrigin = "Anonymous";
            img.src = imageUrl + (imageUrl.includes('?') ? '&' : '?') + 'cb=' + Date.now(); 
            await new Promise((resolve, reject) => { img.onload = resolve; img.onerror = reject; });
            
            const canvas = document.createElement('canvas');
            canvas.width = img.width * scaleFactor;
            canvas.height = img.height * scaleFactor;
            const ctx = canvas.getContext('2d');
            
            ctx.imageSmoothingEnabled = true;
            ctx.imageSmoothingQuality = "high";
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            
            // Permanent Bottom-Right Watermark
            const watermarkText = "ImagixPro";
            ctx.font = `bold ${Math.max(22 * scaleFactor, canvas.width * 0.03)}px "Plus Jakarta Sans"`;
            const textWidth = ctx.measureText(watermarkText).width;
            
            ctx.fillStyle = "rgba(255, 255, 255, 0.85)";
            ctx.shadowColor = "rgba(0, 0, 0, 0.9)";
            ctx.shadowBlur = 10 * scaleFactor;
            
            // Positioning right corner (20px padding)
            const paddingX = 25 * scaleFactor;
            const paddingY = 25 * scaleFactor;
            ctx.fillText(watermarkText, canvas.width - textWidth - paddingX, canvas.height - paddingY);
            
            const a = document.createElement('a');
            a.href = canvas.toDataURL('image/png', 1.0);
            a.download = `ImagixPro_${scaleFactor === 2 ? '2K_Ultra' : '1K'}_${Date.now()}.png`;
            a.click();
            showToast(`Downloaded successfully in ${scaleFactor === 2 ? '2K' : '1K'}!`);
        } catch(err) {
            showToast("Download failed. Connection issue.", true);
        }
    }

    // ----- Smart Event Delegation (Long Press & Click) -----
    let pressTimer;
    let isLongPress = false;
    let startX = 0, startY = 0;

    const clearPress = () => { clearTimeout(pressTimer); };

    document.addEventListener('touchstart', (e) => {
        const el = e.target.closest('.interactable-img');
        if (!el) return;
        isLongPress = false;
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
        const url = el.getAttribute('data-url');
        const prompt = el.getAttribute('data-prompt');
        
        pressTimer = setTimeout(() => {
            isLongPress = true;
            if(navigator.vibrate) navigator.vibrate(50);
            openDownloadModal(url, prompt);
        }, 1500); 
    }, {passive: true});

    document.addEventListener('touchmove', (e) => {
        if (!pressTimer) return;
        if (Math.abs(e.touches[0].clientX - startX) > 10 || Math.abs(e.touches[0].clientY - startY) > 10) clearPress();
    }, {passive: true});

    document.addEventListener('touchend', clearPress);
    document.addEventListener('touchcancel', clearPress);

    document.addEventListener('mousedown', (e) => {
        const el = e.target.closest('.interactable-img');
        if (!el || e.button !== 0) return;
        isLongPress = false;
        startX = e.clientX;
        startY = e.clientY;
        const url = el.getAttribute('data-url');
        const prompt = el.getAttribute('data-prompt');
        
        pressTimer = setTimeout(() => {
            isLongPress = true;
            openDownloadModal(url, prompt);
        }, 1500);
    });

    document.addEventListener('mousemove', (e) => {
        if (!pressTimer) return;
        if (Math.abs(e.clientX - startX) > 10 || Math.abs(e.clientY - startY) > 10) clearPress();
    });

    document.addEventListener('mouseup', clearPress);

    document.addEventListener('click', (e) => {
        const el = e.target.closest('.interactable-img');
        if (!el) return;
        if (isLongPress) { e.preventDefault(); e.stopPropagation(); return; }
        if (dlModal.classList.contains('active') || fsModal.classList.contains('active')) return;
        
        const url = el.getAttribute('data-url');
        const prompt = el.getAttribute('data-prompt');
        if(url) {
            fsImage.src = url;
            fsImgWrapper.setAttribute('data-url', url);
            fsImgWrapper.setAttribute('data-prompt', prompt);
            fsModal.classList.add('active');
        }
    }, true);

    fsDownloadTrigger.onclick = (e) => { e.stopPropagation(); openDownloadModal(fsImgWrapper.getAttribute('data-url'), fsImgWrapper.getAttribute('data-prompt')); };
    fsCopy.onclick = (e) => { e.stopPropagation(); navigator.clipboard.writeText(fsImgWrapper.getAttribute('data-prompt')); showToast("Prompt copied!"); };
    fsClose.onclick = () => fsModal.classList.remove('active');


    // ----- 50 Seconds Cooldown Timer -----
    function startCooldownTimer() {
        let remaining = 50;
        canGenerate = false;
        generateBtn.disabled = true;
        generateBtn.classList.add('cooldown-btn');
        generateBtn.innerHTML = `<i class="fas fa-hourglass-half"></i> Wait ${remaining}s`;

        cooldownTimer = setInterval(() => {
            remaining--;
            generateBtn.innerHTML = `<i class="fas fa-hourglass-half"></i> Wait ${remaining}s`;
            
            if(remaining <= 0) {
                clearInterval(cooldownTimer);
                canGenerate = true;
                generateBtn.disabled = false;
                generateBtn.classList.remove('cooldown-btn');
                generateBtn.innerHTML = '<i class="fas fa-wand-magic-sparkles"></i> Generate';
            }
        }, 1000);
    }

    // ----- ImagixPro Generator Logic -----
    async function processGeneration() {
        if(!canGenerate) return;
        let rawPrompt = promptInput.value.trim();
        if(rawPrompt === "") { showToast("Please describe your vision", true); return; }
        
        let negative = "lowres, bad anatomy, bad hands, text, error, missing fingers, extra digit, fewer digits, cropped, worst quality, low quality, normal quality, jpeg artifacts, signature, watermark, blurry";
        let positive = rawPrompt;
        
        const noIndex = rawPrompt.indexOf('--no');
        if(noIndex !== -1) {
            positive = rawPrompt.substring(0, noIndex).trim();
            negative += ", " + rawPrompt.substring(noIndex + 4).trim();
        }
        
        const proModifiers = ", masterpiece, best quality, ultra-detailed, photorealistic, 8k resolution, cinematic lighting, dramatic, hyperrealistic";
        let finalPrompt = positive + proModifiers;

        // Force 1024x1024 internally since size selector is removed
        const dims = { w: 1024, h: 1024 };
        let seed = Math.floor(Math.random() * 9999999);

        // UI Reset For Generation
        canGenerate = false;
        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating 8K...';
        switchUIState('loading');
        statusMsg.innerText = "Igniting ImagixPro Engines...";
        
        const encoded = encodeURIComponent(finalPrompt + " --no " + negative);
        const imageUrl = `https://image.pollinations.ai/prompt/${encoded}?width=${dims.w}&height=${dims.h}&seed=${seed}&nologo=true&model=flux`;

        let stepInterval = setInterval(() => {
            if(statusMsg.innerText.includes("Engines")) statusMsg.innerText = "Synthesizing ultra-realistic details...";
            else if(statusMsg.innerText.includes("Synthesizing")) statusMsg.innerText = "Applying cinematic lighting...";
            else if(statusMsg.innerText.includes("Applying")) statusMsg.innerText = "Finalizing masterpiece...";
        }, 3000);

        try {
            const preloader = new Image();
            preloader.crossOrigin = "Anonymous";
            await Promise.race([
                new Promise((res, rej) => { preloader.onload = res; preloader.onerror = rej; preloader.src = imageUrl; }),
                new Promise((_, rej) => setTimeout(() => rej(new Error("Timeout")), 45000))
            ]);
            
            clearInterval(stepInterval);
            
            outputImage.src = imageUrl;
            mainWrapperNode.setAttribute('data-url', imageUrl);
            mainWrapperNode.setAttribute('data-prompt', positive);
            
            switchUIState('result');
            addToHistory(imageUrl, positive);
            showToast("Masterpiece Generated Successfully!");
            
            // Start 50s cooldown after successful generation
            startCooldownTimer();

        } catch(err) {
            clearInterval(stepInterval);
            statusMsg.innerText = "Network busy. Please try again.";
            showToast("Generation failed. Check connection.", true);
            setTimeout(() => { 
                switchUIState('welcome'); 
                canGenerate = true; 
                generateBtn.disabled = false;
                generateBtn.innerHTML = '<i class="fas fa-wand-magic-sparkles"></i> Generate';
            }, 3000); 
        }
    }

    // Tools & Utils
    function showToast(msg, isError=false) {
        document.querySelectorAll('.toast').forEach(t => t.remove());
        const toast = document.createElement('div'); toast.className = 'toast';
        const color = isError ? '#ef4444' : '#d4af37';
        toast.innerHTML = `<i class="fas ${isError ? 'fa-triangle-exclamation' : 'fa-check'}" style="color: ${color}"></i> ${msg}`;
        document.body.appendChild(toast);
        requestAnimationFrame(() => setTimeout(() => toast.classList.add('show'), 10));
        setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 400); }, 3000);
    }

    function toggleSidebar(force = null) {
        const state = force !== null ? force : !sidebar.classList.contains('open');
        sidebar.classList.toggle('open', state);
        sidebarOverlay.classList.toggle('show', state);
    }

    generateBtn.addEventListener('click', processGeneration);
    menuToggle.addEventListener('click', () => toggleSidebar(true));
    closeSidebar.addEventListener('click', () => toggleSidebar(false));
    sidebarOverlay.addEventListener('click', () => toggleSidebar(false));
    
    promptInput.addEventListener('keydown', (e) => {
        if(e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); generateBtn.click(); }
    });
    document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape') { fsModal.classList.remove('active'); dlModal.classList.remove('active'); toggleSidebar(false); }
    });
    
    (function antiScreenshot() {
        const p = document.getElementById('screenshotProtector');
        const protect = () => { p.style.opacity='1'; setTimeout(()=>p.style.opacity='0', 250); };
        window.addEventListener('keydown', e => { if(e.key === 'PrintScreen') protect(); });
        document.addEventListener('visibilitychange', () => { if(document.hidden) protect(); });
        window.addEventListener('blur', protect);
    })();

    switchUIState('welcome');
    loadHistoryFromStorage();
</script>
</body>
</html>