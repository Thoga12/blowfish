<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE DECRYPTION - Security System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        .font-orbitron { font-family: 'Orbitron', monospace; }
        .font-mono { font-family: 'Roboto Mono', monospace; }

        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.08;
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: gridPulse 4s ease-in-out infinite;
        }

        @keyframes gridPulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.1; }
        }

        .glow-cyan {
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.15), inset 0 0 30px rgba(0, 255, 255, 0.05);
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
        }

        .pulse-dot {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(0, 255, 0, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(0, 255, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 255, 0, 0); }
        }

        .processing-animation {
            animation: processing 2s linear infinite;
        }

        @keyframes processing {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        .file-drop-zone {
            border: 2px dashed rgba(0, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .file-drop-zone.dragover {
            border-color: #00ffff;
            background-color: rgba(0, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
        }

        .input-focus:focus {
            border-color: #00ffff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            background-color: rgba(0, 255, 255, 0.05);
        }

        .terminal-output {
            font-family: 'Roboto Mono', monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #00ff00;
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 255, 0, 0.3);
            border-radius: 8px;
            padding: 16px;
            max-height: 200px;
            overflow-y: auto;
        }

        @keyframes typewriter {
            from { width: 0; }
            to { width: 100%; }
        }

        .typewriter {
            overflow: hidden;
            white-space: nowrap;
            animation: typewriter 0.5s steps(40, end);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-black via-slate-900 to-blue-900 min-h-screen py-8 overflow-x-hidden relative font-mono">
    <!-- Matrix Background -->
    <div class="matrix-bg" id="matrixBg"></div>

    <!-- Grid Overlay -->
    <div class="fixed inset-0 grid-pattern z-10"></div>

    <!-- Main Container -->
    <div class="container mx-auto px-4 relative z-20">
        <nav class="relative z-20 mb-8">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex items-center justify-between">
                    <a href="/dashboard">
                    <div class="font-orbitron text-2xl font-bold text-cyan-400 text-glow">
                        🔐 SECURES SYSTEM
                    </div>
                    </a>
                    <a href="/enkripsi">
                    <div class="text-green-400 text-sm">
                        <span class="text-cyan-400">></span> FILE DECRYPTION MODULE
                    </div>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="font-orbitron text-5xl font-black text-cyan-400 text-glow mb-4">
                FILE DECRYPTION
            </div>
            <div class="text-green-400 text-lg opacity-80 tracking-widest">
                SECURE FILE DECRYPTION SYSTEM
            </div>
            <div class="text-cyan-400 text-sm mt-2 opacity-60">
                <span class="text-green-400">></span> Decrypt your .enc files with authorized key
            </div>
        </div>

        <!-- System Status -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-black bg-opacity-80 backdrop-blur-lg border border-green-400 border-opacity-30 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-400 rounded-full mr-3 pulse-dot"></div>
                        <span class="text-green-400 text-sm font-bold">DECRYPTION ENGINE: ONLINE</span>
                    </div>
                    <div class="text-cyan-400 text-xs">
                        SUPPORTED: AES-256, RSA-2048, ChaCha20
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-black bg-opacity-80 backdrop-blur-lg border-2 border-cyan-400 border-opacity-30 rounded-2xl p-8 glow-cyan">

                <!-- File Upload Section -->
                <div class="mb-8">
                    <h2 class="text-cyan-400 text-xl font-bold mb-4 uppercase tracking-wide">
                        📁 ENCRYPTED FILE UPLOAD
                    </h2>

                    <div class="file-drop-zone bg-black bg-opacity-50 rounded-xl p-8 text-center cursor-pointer" id="dropZone">
                        <div class="text-cyan-400 text-4xl mb-4">⬆️</div>
                        <div class="text-cyan-400 text-lg font-bold mb-2">Drop .enc file here</div>
                        <div class="text-gray-400 text-sm mb-4">or click to browse</div>
                        <input type="file" id="fileInput" accept=".enc" class="hidden">
                        <button class="bg-cyan-400 bg-opacity-20 hover:bg-opacity-30 text-cyan-400 px-6 py-2 rounded-lg border border-cyan-400 border-opacity-50 transition-all">
                            SELECT FILE
                        </button>
                    </div>

                    <!-- File Info -->
                    <div id="fileInfo" class="hidden mt-4 p-4 bg-green-400 bg-opacity-10 border border-green-400 border-opacity-30 rounded-lg">
                        <div class="text-green-400 font-bold text-sm">✓ FILE LOADED</div>
                        <div id="fileName" class="text-white text-sm mt-1"></div>
                        <div id="fileSize" class="text-gray-400 text-xs mt-1"></div>
                    </div>
                </div>

                <!-- Decryption Key Section -->
                <div class="mb-8">
                    <h2 class="text-cyan-400 text-xl font-bold mb-4 uppercase tracking-wide">
                        🔑 DECRYPTION KEY
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase tracking-wide">
                                ENTER DECRYPTION KEY
                            </label>
                            <input
                                type="password"
                                id="decryptionKey"
                                class="w-full px-4 py-3 bg-black bg-opacity-70 border-2 border-cyan-400 border-opacity-30 rounded-lg text-cyan-400 font-mono transition-all duration-300 focus:outline-none input-focus placeholder-cyan-400 placeholder-opacity-50"
                                placeholder="Enter your decryption key..."
                                autocomplete="off"
                            >
                        </div>

                        <div class="flex items-center space-x-4">
                            <button id="showKeyBtn" class="text-cyan-400 text-sm hover:text-white transition-colors">
                                👁️ Show Key
                            </button>
                            <button id="generateKeyBtn" class="text-yellow-400 text-sm hover:text-white transition-colors">
                                🎲 Generate Test Key
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Process Button -->
                <div class="mb-8">
                    <button
                        id="decryptBtn"
                        class="w-full py-4 bg-gradient-to-r from-cyan-400 to-green-400 text-black font-orbitron font-bold text-lg uppercase tracking-widest rounded-lg transition-all duration-300 btn-hover disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled
                    >
                        🔓 START DECRYPTION PROCESS
                    </button>
                </div>

                <!-- Processing Status -->
                <div id="processingSection" class="hidden mb-8">
                    <h3 class="text-cyan-400 text-lg font-bold mb-4">⚡ DECRYPTION IN PROGRESS</h3>
                    <div class="bg-black bg-opacity-70 rounded-lg p-4">
                        <div class="flex justify-between text-sm text-cyan-400 mb-2">
                            <span>Processing...</span>
                            <span id="progressText">0%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div id="progressBar" class="h-full bg-gradient-to-r from-cyan-400 to-green-400 transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Terminal Output -->
                <div id="terminalSection" class="hidden mb-8">
                    <h3 class="text-green-400 text-lg font-bold mb-4">💻 SYSTEM LOG</h3>
                    <div id="terminal" class="terminal-output">
                        <div class="text-green-400">[SYSTEM] Decryption engine initialized...</div>
                    </div>
                </div>

                <!-- Download Section -->
                <div id="downloadSection" class="hidden">
                    <h3 class="text-green-400 text-lg font-bold mb-4">📥 DECRYPTED FILE READY</h3>
                    <div class="bg-green-400 bg-opacity-10 border border-green-400 border-opacity-30 rounded-lg p-6 text-center">
                        <div class="text-green-400 text-4xl mb-4">✅</div>
                        <div class="text-green-400 font-bold text-lg mb-2">DECRYPTION SUCCESSFUL</div>
                        <div class="text-gray-300 text-sm mb-4">Your file has been successfully decrypted</div>
                        <button id="downloadBtn" class="bg-green-400 hover:bg-green-300 text-black font-bold py-3 px-6 rounded-lg transition-all">
                            ⬇️ DOWNLOAD DECRYPTED FILE
                        </button>
                    </div>
                </div>

                <!-- Error Section -->
                <div id="errorSection" class="hidden">
                    <div class="bg-red-400 bg-opacity-10 border border-red-400 border-opacity-30 rounded-lg p-6 text-center">
                        <div class="text-red-400 text-4xl mb-4">❌</div>
                        <div class="text-red-400 font-bold text-lg mb-2">DECRYPTION FAILED</div>
                        <div id="errorMessage" class="text-gray-300 text-sm mb-4"></div>
                        <button id="retryBtn" class="bg-red-400 hover:bg-red-300 text-black font-bold py-3 px-6 rounded-lg transition-all">
                            🔄 TRY AGAIN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedFile = null;
        let blob = null;

        // Matrix Rain Effect
        function createMatrixRain() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            document.getElementById('matrixBg').appendChild(canvas);

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const chars = '01ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
            const charArray = chars.split('');
            const fontSize = 14;
            const columns = canvas.width / fontSize;
            const drops = Array(Math.floor(columns)).fill(1);

            function draw() {
                ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = '#00ffff';
                ctx.font = fontSize + 'px monospace';

                drops.forEach((y, x) => {
                    const text = charArray[Math.floor(Math.random() * charArray.length)];
                    ctx.fillText(text, x * fontSize, y * fontSize);

                    if (y * fontSize > canvas.height && Math.random() > 0.975) {
                        drops[x] = 0;
                    }
                    drops[x]++;
                });
            }

            setInterval(draw, 35);
        }

        // File Drop Zone
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const decryptBtn = document.getElementById('decryptBtn');

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            handleFile(e.dataTransfer.files[0]);
        });

        fileInput.addEventListener('change', (e) => {
            handleFile(e.target.files[0]);
        });

        function handleFile(file) {
            if (!file) return;

            if (!file.name.endsWith('.enc')) {
                alert('Please select a .enc file');
                return;
            }

            selectedFile = file;
            fileName.textContent = `📄 ${file.name}`;
            fileSize.textContent = `📊 Size: ${(file.size / 1024).toFixed(2)} KB`;
            fileInfo.classList.remove('hidden');
            updateDecryptButton();
        }

        // Decryption Key
        const decryptionKey = document.getElementById('decryptionKey');
        const showKeyBtn = document.getElementById('showKeyBtn');
        const generateKeyBtn = document.getElementById('generateKeyBtn');

        showKeyBtn.addEventListener('click', () => {
            const input = decryptionKey;
            if (input.type === 'password') {
                input.type = 'text';
                showKeyBtn.textContent = '🙈 Hide Key';
            } else {
                input.type = 'password';
                showKeyBtn.textContent = '👁️ Show Key';
            }
        });

        generateKeyBtn.addEventListener('click', () => {
            const testKey = 'demo-key-' + Math.random().toString(36).substr(2, 8);
            decryptionKey.value = testKey;
            updateDecryptButton();
        });

        decryptionKey.addEventListener('input', updateDecryptButton);

        function updateDecryptButton() {
            const hasFile = selectedFile !== null;
            const hasKey = decryptionKey.value.trim().length > 0;

            decryptBtn.disabled = !(hasFile && hasKey);

            if (hasFile && hasKey) {
                decryptBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                decryptBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Decryption Process
        decryptBtn.addEventListener('click', startDecryption);

        function startDecryption() {
            if (!selectedFile || !decryptionKey.value.trim()) return;

            // Hide previous results
            document.getElementById('downloadSection').classList.add('hidden');
            document.getElementById('errorSection').classList.add('hidden');

            // Show processing
            document.getElementById('processingSection').classList.remove('hidden');
            document.getElementById('terminalSection').classList.remove('hidden');

            // Disable button
            decryptBtn.disabled = true;

            const terminal = document.getElementById('terminal');
    terminal.innerHTML = `<div class="text-green-400">[SYSTEM] Sending file to server for decryption...</div>`;

    // Kirim ke Laravel
    const formData = new FormData();
    formData.append("file", selectedFile);
    formData.append("key", decryptionKey.value);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch("/decrypt", {
        method: "POST",
        body: formData,
        headers: {
                        "X-CSRF-TOKEN": csrfToken
                    }

    })
    .then(response => {
        if (!response.ok) throw new Error("Decryption failed on server.");
        return response.blob();
    })
    .then(responseBlob  => {
        blob = responseBlob;
        const originalName = selectedFile.name.replace('.enc', '');
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = originalName;
        a.click();

        document.getElementById('processingSection').classList.add('hidden');
        document.getElementById('downloadSection').classList.remove('hidden');
        // document.getElementById('encryptedFileName').textContent = originalName;
        decryptBtn.disabled = false;
    })
    .catch(err => {
        console.error(err);
        document.getElementById('processingSection').classList.add('hidden');
        document.getElementById('errorSection').classList.remove('hidden');
        document.getElementById('errorMessage').textContent = err.message;
        decryptBtn.disabled = false;
    });
            // Simulate decryption process
            // simulateDecryption();
        }

        function simulateDecryption() {
            const terminal = document.getElementById('terminal');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');

            const logs = [
                '[SYSTEM] Analyzing encrypted file...',
                '[CRYPTO] Validating decryption key...',
                '[CRYPTO] Key validation successful',
                '[ENGINE] Initializing AES-256 decryption...',
                '[ENGINE] Processing file blocks...',
                '[ENGINE] Block 1/4 decrypted',
                '[ENGINE] Block 2/4 decrypted',
                '[ENGINE] Block 3/4 decrypted',
                '[ENGINE] Block 4/4 decrypted',
                '[SYSTEM] Verifying file integrity...',
                '[SYSTEM] Decryption completed successfully'
            ];

            let currentLog = 0;
            let progress = 0;

            const processInterval = setInterval(() => {
                if (currentLog < logs.length) {
                    const logDiv = document.createElement('div');
                    logDiv.className = 'typewriter';
                    logDiv.textContent = logs[currentLog];
                    terminal.appendChild(logDiv);
                    terminal.scrollTop = terminal.scrollHeight;
                    currentLog++;
                }

                progress += 9;
                if (progress > 100) progress = 100;

                progressBar.style.width = progress + '%';
                progressText.textContent = progress + '%';

                if (progress >= 100 && currentLog >= logs.length) {
                    clearInterval(processInterval);

                    // Simulate random success/failure
                    const success = Math.random() > 0.3; // 70% success rate

                    setTimeout(() => {
                        if (success) {
                            showDecryptionSuccess();
                        } else {
                            showDecryptionError();
                        }
                    }, 1000);
                }
            }, 300);
        }

        function showDecryptionSuccess() {
            document.getElementById('processingSection').classList.add('hidden');
            document.getElementById('downloadSection').classList.remove('hidden');

            // Create a demo decrypted file
            const originalName = selectedFile.name.replace('.enc', '');
            const content = `This is a decrypted file: ${originalName}\nDecrypted at: ${new Date().toLocaleString()}\nOriginal size: ${selectedFile.size} bytes`;
            blob = new Blob([content], { type: 'text/plain' });

            decryptBtn.disabled = false;
        }

        function showDecryptionError() {
            document.getElementById('processingSection').classList.add('hidden');
            document.getElementById('errorSection').classList.remove('hidden');

            const errors = [
                'Invalid decryption key provided',
                'File corruption detected',
                'Unsupported encryption algorithm',
                'Key length insufficient for this file'
            ];

            document.getElementById('errorMessage').textContent = errors[Math.floor(Math.random() * errors.length)];
            decryptBtn.disabled = false;
        }

        // Download functionality
        document.getElementById('downloadBtn').addEventListener('click', () => {
            if (!blob) return;

            const originalName = selectedFile.name.replace('.enc', '');
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = originalName;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        });

        // Retry functionality
        document.getElementById('retryBtn').addEventListener('click', () => {
            document.getElementById('errorSection').classList.add('hidden');
            document.getElementById('terminalSection').classList.add('hidden');
            const terminal = document.getElementById('terminal');
            terminal.innerHTML = '<div class="text-green-400">[SYSTEM] Decryption engine initialized...</div>';
        });

        // Initialize
        createMatrixRain();

        // Handle window resize
        window.addEventListener('resize', function() {
            const canvas = document.querySelector('#matrixBg canvas');
            if (canvas) {
                canvas.remove();
                createMatrixRain();
            }
        });
    </script>
</body>
</html>
