<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE ENCRYPTION - Secure System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Roboto+Mono:wght@300;400;700&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .font-orbitron {
            font-family: 'Orbitron', monospace;
        }

        .font-mono {
            font-family: 'Roboto Mono', monospace;
        }

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

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.1;
            }
        }

        .glow-cyan {
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2), inset 0 0 30px rgba(0, 255, 255, 0.05);
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
            animation: textGlow 2s ease-in-out infinite;
        }

        @keyframes textGlow {

            0%,
            100% {
                text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
            }

            50% {
                text-shadow: 0 0 30px rgba(0, 255, 255, 1), 0 0 40px rgba(0, 255, 255, 0.6);
            }
        }

        .pulse-dot {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 255, 0, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(0, 255, 0, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 255, 0, 0);
            }
        }

        .progress-bar {
            width: 0%;
            animation: progress 3s ease-in-out;
        }

        @keyframes progress {
            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }
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

        .file-drop-zone {
            border: 2px dashed rgba(0, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .file-drop-zone.dragover {
            border-color: #00ffff;
            background-color: rgba(0, 255, 255, 0.05);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }

        .encryption-animation {
            animation: encrypt 0.5s ease-in-out infinite;
        }

        @keyframes encrypt {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .success-pulse {
            animation: successPulse 0.6s ease-in-out;
        }

        @keyframes successPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-black via-slate-900 to-blue-900 min-h-screen py-8 overflow-x-hidden relative font-mono">
    <!-- Matrix Background -->
    <div class="matrix-bg" id="matrixBg"></div>

    <!-- Grid Overlay -->
    <div class="fixed inset-0 grid-pattern z-10"></div>

    <!-- Navigation -->
    <nav class="relative z-20 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between">
                <a href="/dashboard">
                <div class="font-orbitron text-2xl font-bold text-cyan-400 text-glow">
                    🔐 SECURES SYSTEM
                </div>
                <a href="/dekripsi">
                <div class="text-green-400 text-sm">
                    <span class="text-cyan-400">></span> FILE DECRYPTION MODULE
                </div>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="max-w-4xl mx-auto px-4 relative z-20">

        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="font-orbitron text-5xl font-black text-cyan-400 text-glow mb-4">
                FILE ENCRYPTION
            </div>
            <div class="text-green-400 text-lg opacity-80 tracking-widest mb-6">
                ADVANCED CRYPTOGRAPHIC PROTECTIONS
            </div>

            <!-- Security Status -->
            <div
                class="inline-flex items-center px-6 py-3 bg-green-400 bg-opacity-10 border border-green-400 border-opacity-30 rounded-lg">
                <div class="w-3 h-3 bg-green-400 rounded-full mr-3 pulse-dot"></div>
                <div class="text-green-400 text-sm font-bold tracking-wide">
                    ENCRYPTION ENGINE: ONLINE
                </div>
            </div>
        </div>

        <!-- Main Encryption Panel -->
        <div
            class="bg-black bg-opacity-80 backdrop-blur-lg border-2 border-cyan-400 border-opacity-30 rounded-2xl p-8 glow-cyan">

            <!-- Notification Area -->
            <div id="notification" class="hidden mb-6"></div>

            <!-- File Upload Section -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="text-cyan-400 font-bold text-lg font-orbitron mr-3">01.</div>
                    <h2 class="text-cyan-400 font-bold text-xl tracking-wide">SELECT FILE</h2>
                </div>

                <div id="dropZone" class="file-drop-zone rounded-xl p-8 text-center cursor-pointer">
                    <div id="dropContent">
                        <div class="text-6xl mb-4">📁</div>
                        <div class="text-cyan-400 text-lg font-bold mb-2">
                            DROP FILE HERE OR CLICK TO BROWSE
                        </div>
                        <div class="text-cyan-400 text-opacity-60 text-sm">
                            Supported: All file types • Max size: 10MB
                        </div>
                    </div>

                    <div id="fileInfo" class="hidden">
                        <div class="text-4xl mb-3">✅</div>
                        <div class="text-green-400 font-bold text-lg" id="fileName"></div>
                        <div class="text-cyan-400 text-sm" id="fileSize"></div>
                        <button type="button" class="mt-3 text-red-400 hover:text-red-300 text-sm underline"
                            id="removeFile">
                            Remove File
                        </button>
                    </div>
                </div>

                <input type="file" id="fileInput" class="hidden" accept="*/*">
            </div>

            <!-- Encryption Key Section -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="text-cyan-400 font-bold text-lg font-orbitron mr-3">02.</div>
                    <h2 class="text-cyan-400 font-bold text-xl tracking-wide">ENCRYPTION KEY</h2>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-cyan-400 text-sm font-bold uppercase tracking-wider mb-2">
                            Password / Key
                        </label>
                        <input type="password" id="encryptionKey"
                            class="w-full px-5 py-4 bg-black bg-opacity-70 border-2 border-cyan-400 border-opacity-30 rounded-lg text-cyan-400 font-mono transition-all duration-300 focus:outline-none input-focus placeholder-cyan-400 placeholder-opacity-50"
                            placeholder="Enter your encryption password" minlength="8" required>
                        <div class="text-cyan-400 text-opacity-60 text-xs mt-2">
                            Minimum 8 characters • Use strong password for better security
                        </div>
                    </div>

                    <div>
                        <label class="block text-cyan-400 text-sm font-bold uppercase tracking-wider mb-2">
                            Confirm Password
                        </label>
                        <input type="password" id="confirmKey"
                            class="w-full px-5 py-4 bg-black bg-opacity-70 border-2 border-cyan-400 border-opacity-30 rounded-lg text-cyan-400 font-mono transition-all duration-300 focus:outline-none input-focus placeholder-cyan-400 placeholder-opacity-50"
                            placeholder="Confirm your encryption password" required>
                    </div>

                    <!-- Key Strength Indicator -->
                    <div class="flex items-center space-x-2" id="keyStrength">
                        <div class="text-cyan-400 text-sm">Key Strength:</div>
                        <div class="flex space-x-1">
                            <div class="w-6 h-2 bg-gray-600 rounded-full" id="strength1"></div>
                            <div class="w-6 h-2 bg-gray-600 rounded-full" id="strength2"></div>
                            <div class="w-6 h-2 bg-gray-600 rounded-full" id="strength3"></div>
                            <div class="w-6 h-2 bg-gray-600 rounded-full" id="strength4"></div>
                        </div>
                        <div class="text-sm" id="strengthText">-</div>
                    </div>
                </div>
            </div>

            <!-- Process Section -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="text-cyan-400 font-bold text-lg font-orbitron mr-3">03.</div>
                    <h2 class="text-cyan-400 font-bold text-xl tracking-wide">PROCESS</h2>
                </div>

                <button type="button" id="encryptBtn"
                    class="w-full py-5 bg-gradient-to-r from-cyan-400 to-green-400 text-black font-orbitron font-bold text-lg uppercase tracking-widest rounded-lg transition-all duration-300 btn-hover active:transform-none disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    🔒 ENCRYPT FILE
                </button>
            </div>

            <!-- Progress Section -->
            <div id="progressSection" class="hidden mb-8">
                <div class="text-center mb-4">
                    <div class="text-cyan-400 font-bold text-lg encryption-animation" id="progressText">
                        ENCRYPTING FILE...
                    </div>
                </div>
                <div class="w-full h-3 bg-cyan-400 bg-opacity-20 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-cyan-400 to-green-400 rounded-full progress-bar"
                        id="progressBar"></div>
                </div>
                <div class="text-center mt-2 text-cyan-400 text-sm" id="progressPercent">0%</div>
            </div>

            <!-- Download Section -->
            <div id="downloadSection" class="hidden">
                <div class="flex items-center mb-4">
                    <div class="text-green-400 font-bold text-lg font-orbitron mr-3">✓</div>
                    <h2 class="text-green-400 font-bold text-xl tracking-wide">ENCRYPTION COMPLETE</h2>
                </div>

                <div
                    class="bg-green-400 bg-opacity-10 border border-green-400 border-opacity-30 rounded-lg p-6 text-center">
                    <div class="text-5xl mb-4">🔐</div>
                    <div class="text-green-400 font-bold text-lg mb-2">File Successfully Encrypted</div>
                    <div class="text-cyan-400 text-sm mb-4" id="encryptedFileName"></div>

                    <button type="button" id="downloadBtn"
                        class="px-8 py-3 bg-gradient-to-r from-green-400 to-cyan-400 text-black font-orbitron font-bold uppercase tracking-wide rounded-lg transition-all duration-300 btn-hover">
                        📥 DOWNLOAD ENCRYPTED FILE
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-8 text-cyan-400 text-opacity-60 text-sm">
            {{-- <div class="mb-2">
                <span class="text-green-400">></span> AES-256 Encryption Algorithm
            </div> --}}
            <div>
                <span class="text-green-400">></span> Secure file processing in browser memory
            </div>
        </div>
    </div>

    <script>
        // Global variables
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

        // File handling
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const dropContent = document.getElementById('dropContent');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFileBtn = document.getElementById('removeFile');

        // Drag and drop events
        dropZone.addEventListener('click', () => fileInput.click());
        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('dragleave', handleDragLeave);
        dropZone.addEventListener('drop', handleDrop);
        fileInput.addEventListener('change', handleFileSelect);
        removeFileBtn.addEventListener('click', removeFile);

        function handleDragOver(e) {
            e.preventDefault();
            dropZone.classList.add('dragover');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
        }

        function handleDrop(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                processFile(files[0]);
            }
        }

        function handleFileSelect(e) {
            const files = e.target.files;
            if (files.length > 0) {
                processFile(files[0]);
            }
        }

        function processFile(file) {
            // Check file size (10MB limit)
            if (file.size > 10 * 1024 * 1024) {
                showNotification('File size exceeds 10MB limit!', 'error');
                return;
            }

            selectedFile = file;
            dropContent.classList.add('hidden');
            fileInfo.classList.remove('hidden');
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);

            validateForm();
        }

        function removeFile() {
            selectedFile = null;
            fileInput.value = '';
            dropContent.classList.remove('hidden');
            fileInfo.classList.add('hidden');
            validateForm();
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Password strength checker
        const encryptionKey = document.getElementById('encryptionKey');
        const confirmKey = document.getElementById('confirmKey');

        encryptionKey.addEventListener('input', checkPasswordStrength);
        confirmKey.addEventListener('input', validateForm);

        function checkPasswordStrength() {
            const password = encryptionKey.value;
            const strength = calculatePasswordStrength(password);
            updateStrengthIndicator(strength);
            validateForm();
        }

        function calculatePasswordStrength(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            return Math.min(score, 4);
        }

        function updateStrengthIndicator(strength) {
            const indicators = document.querySelectorAll('[id^="strength"]');
            const strengthText = document.getElementById('strengthText');
            const colors = ['bg-gray-600', 'bg-red-400', 'bg-yellow-400', 'bg-orange-400', 'bg-green-400'];
            const texts = ['-', 'Very Weak', 'Weak', 'Medium', 'Strong'];
            const textColors = ['text-gray-400', 'text-red-400', 'text-yellow-400', 'text-orange-400', 'text-green-400'];

            indicators.forEach((indicator, index) => {
                indicator.className = `w-6 h-2 rounded-full ${index < strength ? colors[strength] : 'bg-gray-600'}`;
            });

            strengthText.textContent = texts[strength];
            strengthText.className = `text-sm ${textColors[strength]}`;
        }

        // Form validation
        function validateForm() {
            const encryptBtn = document.getElementById('encryptBtn');
            const key1 = encryptionKey.value;
            const key2 = confirmKey.value;

            const isValid = selectedFile &&
                key1.length >= 8 &&
                key1 === key2;

            encryptBtn.disabled = !isValid;

            if (key1 && key2 && key1 !== key2) {
                confirmKey.classList.add('border-red-400');
                confirmKey.classList.remove('border-cyan-400');
            } else {
                confirmKey.classList.remove('border-red-400');
                confirmKey.classList.add('border-cyan-400');
            }
        }

        // Encryption process
        document.getElementById('encryptBtn').addEventListener('click', encryptFile);

        async function encryptFile() {
            if (!selectedFile || !encryptionKey.value) {
                showNotification('Please select a file and enter encryption key!', 'error');
                return;
            }

            try {
                // Show progress
                document.getElementById('progressSection').classList.remove('hidden');
                document.getElementById('downloadSection').classList.add('hidden');

                // Read file
                // const fileContent = await readFileAsArrayBuffer(selectedFile);

                // Update progress
                updateProgress(25, 'Uploading to server...');

                // Convert to base64 for encryption
                // const base64Content = arrayBufferToBase64(fileContent);
                updateProgress(50, 'Preparing encryption...');

                // Encrypt with CryptoJS
                // const encrypted = CryptoJS.AES.encrypt(base64Content, encryptionKey.value).toString();
                const formData = new FormData();
                formData.append("file", selectedFile);
                formData.append("key", encryptionKey.value);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch("/encrypt", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken
                    }
        //                 headers: {
        //     'X-CSRF-TOKEN': csrfToken
        // },
                })

                if (!response.ok) {
                    console.error("Status code:", response.status);
        const text = await response.text();
                    throw new Error("Encryption failed on server." + response.statusText);
                }
                // .then(response => response.blob())
                // .then(blob => {
                //     const url = URL.createObjectURL(blob);
                //     const a = document.createElement("a");
                //     a.href = url;
                //     a.download = selectedFile.name + ".enc";
                //     a.click();
                // });

                updateProgress(75, 'Encrypting data...');

                 blob = await response.blob();
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = selectedFile.name + ".enc";
                a.click();
                // Create encrypted file data
                // const encryptedFileData = {
                //     originalName: selectedFile.name,
                //     originalSize: selectedFile.size,
                //     encryptedData: encrypted,
                //     timestamp: new Date().toISOString()
                // };
                
                // downloadEncryptedFile(blob, selectedFile.name + '.enc')
                // document.getElementById('downloadBtn').addEventListener('click', downloadEncryptedFile(blob, selectedFile.name + '.enc'));

                // encryptedData = JSON.stringify(encryptedFileData);
                updateProgress(100, 'Encryption complete!');

                // Show download section
                setTimeout(() => {
                    document.getElementById('progressSection').classList.add('hidden');
                    document.getElementById('downloadSection').classList.remove('hidden');
                    document.getElementById('encryptedFileName').textContent = selectedFile.name + '.enc';
                    showNotification('File encrypted successfully!', 'success');
                }, 500);

            } catch (error) {
                console.error('Encryption error:', error);
                showNotification('Encryption failed: ' + error.message, 'error');
                document.getElementById('progressSection').classList.add('hidden');
            }
        }

        function readFileAsArrayBuffer(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = e => resolve(e.target.result);
                reader.onerror = reject;
                reader.readAsArrayBuffer(file);
            });
        }

        function arrayBufferToBase64(buffer) {
            const bytes = new Uint8Array(buffer);
            let binary = '';
            for (let i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i]);
            }
            return btoa(binary);
        }

        function updateProgress(percent, text) {
            document.getElementById('progressPercent').textContent = percent + '%';
            document.getElementById('progressText').textContent = text;
            document.getElementById('progressBar').style.width = percent + '%';
        }

        // Download encrypted file
        // document.getElementById('downloadBtn').addEventListener('click', downloadEncryptedFile);
        // document.getElementById('downloadBtn').addEventListener('click', downloadEncryptedFile(blob, selectedFile.name + '.enc'));
        document.getElementById('downloadBtn').addEventListener('click', () => {
    if (blob && selectedFile) {
        downloadEncryptedFile(blob, selectedFile.name + '.enc');
    } else {
        showNotification('File belum tersedia untuk diunduh.', 'error');
    }
});


        function downloadEncryptedFile(blob, filename) {
            // if (!encryptedData) {
            //     showNotification('No encrypted data available!', 'error');
            //     return;
            // }

            // const blob = new Blob([blob], {
            //     type: 'application/octet-stream'
            // });

            // const blob = await response.blob();
            
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = selectedFile.name + '.enc';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            showNotification('Encrypted file downloaded successfully!', 'success');
        }

        // Notification system
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.className = `p-4 rounded-lg mb-6 text-center font-bold`;

            if (type === 'success') {
                notification.className +=
                    ` bg-green-400 bg-opacity-10 border border-green-400 border-opacity-30 text-green-400 success-pulse`;
            } else if (type === 'error') {
                notification.className += ` bg-red-400 bg-opacity-10 border border-red-400 border-opacity-30 text-red-400`;
            }

            notification.textContent = message;
            notification.classList.remove('hidden');

            setTimeout(() => {
                notification.classList.add('hidden');
            }, 5000);
        }

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
