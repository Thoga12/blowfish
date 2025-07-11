<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE DECRYPTION - School Security System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .font-inter { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }




        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(20px) rotate(240deg); }
        }

        .geometric-pattern {
            background-image:
                radial-gradient(circle at 25% 25%, rgba(220, 38, 38, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            background-size: 60px 60px;
            animation: patternMove 10s linear infinite;
        }

        @keyframes patternMove {
            0% { background-position: 0 0; }
            100% { background-position: 60px 60px; }
        }

        .glow-red {
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.2), inset 0 0 30px rgba(220, 38, 38, 0.05);
        }

        .text-glow-red {
            text-shadow: 0 0 20px rgba(220, 38, 38, 0.8);
        }

        .text-glow-white {
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }

        .pulse-dot {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        .processing-animation {
            animation: processing 2s linear infinite;
        }

        @keyframes processing {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        .file-drop-zone {
            border: 2px dashed rgba(220, 38, 38, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .file-drop-zone::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.1), transparent);
            transition: left 0.5s;
        }

        .file-drop-zone:hover::before {
            left: 100%;
        }

        .file-drop-zone.dragover {
            border-color: #dc2626;
            background-color: rgba(220, 38, 38, 0.1);
            box-shadow: 0 0 20px rgba(220, 38, 38, 0.3);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.4);
        }

        .input-focus:focus {
            border-color: #dc2626;
            box-shadow: 0 0 15px rgba(220, 38, 38, 0.5);
            background-color: rgba(220, 38, 38, 0.05);
        }

        .terminal-output {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #22c55e;
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(34, 197, 94, 0.3);
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

        .school-badge {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            border: 2px solid #ffffff;
            animation: badgeGlow 2s ease-in-out infinite alternate;
        }

        @keyframes badgeGlow {
            0% { box-shadow: 0 0 10px rgba(220, 38, 38, 0.5); }
            100% { box-shadow: 0 0 20px rgba(220, 38, 38, 0.8), 0 0 30px rgba(220, 38, 38, 0.3); }
        }

        .patriotic-gradient {
            /* background: linear-gradient(135deg, #dc2626 0%, #dc2626 50%, #dc2626 100%); */
            background: #dc2626;
            background-size: 400% 400%;
            /* animation: patrioticFlow 4s ease-in-out infinite; */
        }

        @keyframes patrioticFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .book-icon {
            animation: bookFloat 3s ease-in-out infinite;
        }

        @keyframes bookFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-50 via-white to-red-100 min-h-screen py-8 overflow-x-hidden relative font-inter">
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Geometric Pattern Overlay -->
    {{-- <div class="fixed inset-0 geometric-pattern z-10"></div> --}}

    <!-- Main Container -->
    <div class="container mx-auto px-4 relative z-20">
        <nav class="relative z-20 mb-8">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex items-center justify-between">
                    <a href="/dashboard">
                        <div class="font-poppins text-2xl font-bold text-red-600 text-glow-red flex items-center">
                            <span class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white">🔐</span>
                            SECURITY SYSTEM
                        </div>
                    </a>
                    <a href="/enkripsi">
                        <div class="text-red-500 text-sm font-medium">
                            <span class="text-red-600 font-bold">></span> FILE DECRYPTION MODULE
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="font-poppins text-5xl font-black text-red-600 text-glow-red mb-4 flex items-center justify-center">
                <span class="book-icon mr-4">📚</span>
                FILE DECRYPTION
                <span class="book-icon ml-4">🔐</span>
            </div>
            <div class="text-red-500 text-lg opacity-80 tracking-wide font-medium">
                SECURE EDUCATIONAL FILE DECRYPTION SYSTEM
            </div>
            <div class="text-red-400 text-sm mt-2 opacity-60 font-medium">
                <span class="text-red-500 font-bold">></span> Dekripsi file .enc dengan kunci yang terotorisasi
            </div>
        </div>

        <!-- System Status -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white bg-opacity-90 backdrop-blur-lg border border-red-200 rounded-lg p-4 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3 pulse-dot"></div>
                        <span class="text-green-600 text-sm font-bold">SISTEM DEKRIPSI: ONLINE</span>
                    </div>
                    <div class="text-red-500 text-xs font-medium">
                        DIDUKUNG: AES-256, RSA-2048, ChaCha20
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white bg-opacity-95 backdrop-blur-lg border-2 border-red-200 rounded-2xl p-8 shadow-2xl glow-red">

                <!-- File Upload Section -->
                <div class="mb-8">
                    <h2 class="text-red-600 text-xl font-bold mb-4 uppercase tracking-wide font-poppins flex items-center">
                        <span class="mr-2">📁</span> UPLOAD FILE TERENKRIPSI
                    </h2>

                    <div class="file-drop-zone bg-red-50 rounded-xl p-8 text-center cursor-pointer relative" id="dropZone">
                        <div class="text-red-500 text-4xl mb-4">⬆️</div>
                        <div class="text-red-600 text-lg font-bold mb-2">Seret file .enc ke sini</div>
                        <div class="text-gray-500 text-sm mb-4">atau klik untuk memilih file</div>
                        <input type="file" id="fileInput" accept=".enc" class="hidden">
                        <button class="patriotic-gradient text-white px-6 py-2 rounded-lg border-2 border-red-300 transition-all font-medium">
                            PILIH FILE
                        </button>
                    </div>

                    <!-- File Info -->
                    <div id="fileInfo" class="hidden mt-4 p-4 bg-green-50 border border-green-300 rounded-lg">
                        <div class="text-green-600 font-bold text-sm flex items-center">
                            <span class="mr-2">✓</span> FILE BERHASIL DIMUAT
                        </div>
                        <div id="fileName" class="text-gray-700 text-sm mt-1 font-medium"></div>
                        <div id="fileSize" class="text-gray-500 text-xs mt-1"></div>
                    </div>
                </div>

                <!-- Decryption Key Section -->
                <div class="mb-8">
                    <h2 class="text-red-600 text-xl font-bold mb-4 uppercase tracking-wide font-poppins flex items-center">
                        <span class="mr-2">🔑</span> KUNCI DEKRIPSI
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-red-600 text-sm font-bold mb-2 uppercase tracking-wide">
                                MASUKKAN KUNCI DEKRIPSI
                            </label>
                            <input
                                type="password"
                                id="decryptionKey"
                                class="w-full px-4 py-3 bg-white border-2 border-red-200 rounded-lg text-red-600 font-medium transition-all duration-300 focus:outline-none input-focus placeholder-red-300"
                                placeholder="Masukkan kunci dekripsi Anda..."
                                autocomplete="off"
                            >
                        </div>

                        <div class="flex items-center space-x-4">
                            <button id="showKeyBtn" class="text-red-500 text-sm hover:text-red-700 transition-colors font-medium">
                                👁️ Tampilkan Kunci
                            </button>
                            <button id="generateKeyBtn" class="text-orange-500 text-sm hover:text-orange-700 transition-colors font-medium">
                                🎲 Generate Kunci Test
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Process Button -->
                <div class="mb-8">
                    <button
                        id="decryptBtn"
                        class="w-full py-4 patriotic-gradient text-white font-poppins font-bold text-lg uppercase tracking-widest rounded-lg transition-all duration-300 btn-hover disabled:opacity-50 disabled:cursor-not-allowed shadow-lg"
                        disabled
                    >
                        🔓 MULAI PROSES DEKRIPSI
                    </button>
                </div>

                <!-- Processing Status -->
                <div id="processingSection" class="hidden mb-8">
                    <h3 class="text-red-600 text-lg font-bold mb-4 font-poppins flex items-center">
                        <span class="mr-2">⚡</span> DEKRIPSI SEDANG BERLANGSUNG
                    </h3>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <div class="flex justify-between text-sm text-red-600 mb-2 font-medium">
                            <span>Memproses...</span>
                            <span id="progressText">0%</span>
                        </div>
                        <div class="w-full h-2 bg-red-200 rounded-full overflow-hidden">
                            <div id="progressBar" class="h-full patriotic-gradient transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Terminal Output -->
                <div id="terminalSection" class="hidden mb-8">
                    <h3 class="text-green-600 text-lg font-bold mb-4 font-poppins flex items-center">
                        <span class="mr-2">💻</span> LOG SISTEM
                    </h3>
                    <div id="terminal" class="terminal-output">
                        <div class="text-green-500">[SISTEM] Engine dekripsi diinisialisasi...</div>
                    </div>
                </div>

                <!-- Download Section -->
                <div id="downloadSection" class="hidden">
                    <h3 class="text-green-600 text-lg font-bold mb-4 font-poppins flex items-center">
                        <span class="mr-2">📥</span> FILE TERDEKRIPSI SIAP
                    </h3>
                    <div class="bg-green-50 border border-green-300 rounded-lg p-6 text-center">
                        <div class="text-green-500 text-4xl mb-4">✅</div>
                        <div class="text-green-600 font-bold text-lg mb-2">DEKRIPSI BERHASIL</div>
                        <div class="text-gray-600 text-sm mb-4">File Anda telah berhasil didekripsi</div>
                        <button id="downloadBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-lg">
                            ⬇️ UNDUH FILE TERDEKRIPSI
                        </button>
                    </div>
                </div>

                <!-- Error Section -->
                <div id="errorSection" class="hidden">
                    <div class="bg-red-50 border border-red-300 rounded-lg p-6 text-center">
                        <div class="text-red-500 text-4xl mb-4">❌</div>
                        <div class="text-red-600 font-bold text-lg mb-2">DEKRIPSI GAGAL</div>
                        <div id="errorMessage" class="text-gray-600 text-sm mb-4"></div>
                        <button id="retryBtn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-lg">
                            🔄 COBA LAGI
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedFile = null;
        let blob = null;

        // Floating Animation Control
        // function enhanceFloatingShapes() {
        //     const shapes = document.querySelectorAll('.shape');
        //     shapes.forEach((shape, index) => {
        //         shape.style.animationDelay = `${index * 0.5}s`;
        //         shape.style.animationDuration = `${8 + index * 2}s`;
        //     });
        // }

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
                alert('Silakan pilih file .enc');
                return;
            }

            selectedFile = file;
            fileName.textContent = `📄 ${file.name}`;
            fileSize.textContent = `📊 Ukuran: ${(file.size / 1024).toFixed(2)} KB`;
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
                showKeyBtn.textContent = '🙈 Sembunyikan Kunci';
            } else {
                input.type = 'password';
                showKeyBtn.textContent = '👁️ Tampilkan Kunci';
            }
        });

        generateKeyBtn.addEventListener('click', () => {
            const testKey = 'sekolah-key-' + Math.random().toString(36).substr(2, 8);
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
            terminal.innerHTML = `<div class="text-green-500">[SISTEM] Mengirim file ke server untuk dekripsi...</div>`;

            // Send to Laravel
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
                if (!response.ok) throw new Error("Dekripsi gagal di server.");
                return response.blob();
            })
            .then(responseBlob => {
                blob = responseBlob;
                const originalName = selectedFile.name.replace('.enc', '');
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = originalName;
                a.click();

                document.getElementById('processingSection').classList.add('hidden');
                document.getElementById('downloadSection').classList.remove('hidden');
                decryptBtn.disabled = false;
            })
            .catch(err => {
                console.error(err);
                document.getElementById('processingSection').classList.add('hidden');
                document.getElementById('errorSection').classList.remove('hidden');
                document.getElementById('errorMessage').textContent = err.message;
                decryptBtn.disabled = false;
            });
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
            terminal.innerHTML = '<div class="text-green-500">[SISTEM] Engine dekripsi diinisialisasi...</div>';
        });

        Initialize
        enhanceFloatingShapes();

        // Handle window resize
        window.addEventListener('resize', function() {
            enhanceFloatingShapes();
        });
    </script>
</body>
</html>
