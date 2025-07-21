<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SECURE ACCESS - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            opacity: 0.1;
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(239, 68, 68, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(239, 68, 68, 0.03) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: gridPulse 4s ease-in-out infinite;
        }

        @keyframes gridPulse {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.1;
            }
        }

        .glow-red {
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.2), inset 0 0 30px rgba(239, 68, 68, 0.05);
            animation: containerGlow 3s ease-in-out infinite;
        }

        @keyframes containerGlow {
            0%, 100% {
                box-shadow: 0 0 30px rgba(239, 68, 68, 0.2), inset 0 0 30px rgba(239, 68, 68, 0.05);
            }
            50% {
                box-shadow: 0 0 50px rgba(239, 68, 68, 0.4), inset 0 0 50px rgba(239, 68, 68, 0.1);
            }
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(239, 68, 68, 0.8);
            animation: textGlow 2s ease-in-out infinite;
        }

        @keyframes textGlow {
            0%, 100% {
                text-shadow: 0 0 20px rgba(239, 68, 68, 0.8);
            }
            50% {
                text-shadow: 0 0 30px rgba(239, 68, 68, 1), 0 0 40px rgba(239, 68, 68, 0.6);
            }
        }

        .pulse-dot {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        .loading-progress {
            width: 0%;
            animation: loading 2s ease-in-out;
        }

        @keyframes loading {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4);
        }

        .input-focus:focus {
            border-color: #ef4444;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
            background-color: rgba(239, 68, 68, 0.05);
        }

        .patriotic-gradient {
            background: linear-gradient(135deg, #dc2626 0%, #ffffff 25%, #dc2626 50%, #ffffff 75%, #dc2626 100%);
            background-size: 400% 400%;
            animation: patrioticShift 6s ease-in-out infinite;
        }

        @keyframes patrioticShift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-red-900 via-red-800 to-white min-h-screen flex items-center justify-center overflow-hidden relative font-mono">
    <!-- Matrix Background -->
    <div class="matrix-bg" id="matrixBg"></div>

    <!-- Grid Overlay -->
    <div class="fixed inset-0 grid-pattern z-10"></div>

    <!-- Main Login Container -->
    <div
        class="bg-white bg-opacity-95 backdrop-blur-lg border-2 border-red-500 border-opacity-60 rounded-2xl p-10 w-full max-w-md mx-4 relative z-20 glow-red shadow-2xl">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="font-orbitron text-4xl font-black text-red-600 text-glow mb-3">
                SECURE ACCESS
            </div>
            <div class="text-red-700 text-sm opacity-80 tracking-widest font-bold">
                ADMIN AUTHORIZATION REQUIRED
            </div>
        </div>

        <!-- Security Status -->
        <div
            class="flex items-center justify-center mb-6 p-3 bg-green-500 bg-opacity-15 border border-green-500 border-opacity-50 rounded-lg">
            <div class="w-2 h-2 bg-green-500 rounded-full mr-3 pulse-dot"></div>
            <div class="text-green-700 text-xs font-bold tracking-wide">
                SYSTEM SECURITY: ACTIVE
            </div>
        </div>

        <!-- Message Display -->
        <div id="message" class="hidden p-4 rounded-lg mb-6 text-center text-sm"></div>

        <!-- Login Form -->
        <form class="space-y-6" id="loginForm">
            <!-- Username/Email Field -->
            <div class="space-y-2">
                <label class="block text-red-700 text-sm font-bold uppercase tracking-wider" for="username">
                    USERNAME / EMAIL
                </label>
                <input type="text" id="username" name="username"
                    class="w-full px-5 py-4 bg-white bg-opacity-80 border-2 border-red-400 border-opacity-50 rounded-lg text-red-800 font-mono transition-all duration-300 focus:outline-none input-focus placeholder-red-500 placeholder-opacity-60"
                    placeholder="Enter your username or email" required autocomplete="username">
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <label class="block text-red-700 text-sm font-bold uppercase tracking-wider" for="password">
                    PASSWORD
                </label>
                <input type="password" id="password" name="password"
                    class="w-full px-5 py-4 bg-white bg-opacity-80 border-2 border-red-400 border-opacity-50 rounded-lg text-red-800 font-mono transition-all duration-300 focus:outline-none input-focus placeholder-red-500 placeholder-opacity-60"
                    placeholder="Enter your password" required autocomplete="current-password">
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full py-5 bg-gradient-to-r from-red-600 to-red-700 text-white font-orbitron font-bold text-lg uppercase tracking-widest rounded-lg transition-all duration-300 btn-hover active:transform-none disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl"
                id="loginBtn">
                🔐 AUTHENTICATE LOGIN
            </button>
        </form>

        <!-- Loading Animation -->
        <div class="hidden text-center mt-6" id="loading">
            <div class="text-red-600 text-sm mb-3 font-bold">AUTHENTICATING...</div>
            <div class="w-full h-1 bg-red-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full loading-progress"></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-red-600 text-opacity-70 text-xs mt-8 font-mono">
            <span class="text-green-600">></span> Unauthorized access is prohibited and monitored
        </div>

        <!-- Patriotic Decoration -->
        <div class="absolute -top-2 -right-2 w-16 h-16 patriotic-gradient rounded-full opacity-20 pointer-events-none"></div>
        <div class="absolute -bottom-2 -left-2 w-12 h-12 patriotic-gradient rounded-full opacity-20 pointer-events-none"></div>
    </div>

    <script>
        // Matrix Rain Effect with Red Theme
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
                ctx.fillStyle = 'rgba(255, 255, 255, 0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = '#ef4444';
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

        // Form Validation and Submission
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const messageDiv = document.getElementById('message');
            const loadingDiv = document.getElementById('loading');
            const loginBtn = document.getElementById('loginBtn');

            // Clear previous messages
            messageDiv.classList.add('hidden');
            messageDiv.className = 'hidden p-4 rounded-lg mb-6 text-center text-sm';

            // Validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isEmail = emailRegex.test(username);

            if (!username || !password) {
                showMessage('Username/Email dan password harus diisi!', 'error');
                return;
            }

            if (!isEmail && username.length < 3) {
                showMessage('Username minimal 3 karakter atau gunakan format email yang valid!', 'error');
                return;
            }

            if (password.length < 6) {
                showMessage('Password minimal 6 karakter!', 'error');
                return;
            }

            // Show loading
            loginBtn.disabled = true;
            loadingDiv.classList.remove('hidden');

            try {
                const formData = new FormData();
                formData.append("email", username);
                formData.append("password", password);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch("/login", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken
                    }
                });

                const data = await response.json();
                console.log('Raw response:', data);
                if (data.success) {
                    showMessage('Autentikasi berhasil! Mengalihkan...', 'success');
                    setTimeout(() => {
                        const role = data.user.role;
                        if (role === 'admin') {
                            alert('Login berhasil! Dalam aplikasi nyata, Anda akan diarahkan ke dashboard.');
                            window.location.href = '/dashboard';

                        }else if (role === 'pengguna') {
                            alert('Login berhasil! Dalam aplikasi nyata, Anda akan diarahkan ke dashboard.');
                            window.location.href = '/dekripsi';
                        }
                    }, 1500);
                } else {
                    showMessage('Username/Email atau password salah!', 'error');
                }

            } catch (error) {
                console.error('Login error:', error);
                showMessage('Terjadi kesalahan saat menghubungi server.', 'error');
            }

            loadingDiv.classList.add('hidden');
            loginBtn.disabled = false;
        });

        function showMessage(text, type) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = text;
            messageDiv.classList.remove('hidden');

            if (type === 'error') {
                messageDiv.className =
                    'p-4 rounded-lg mb-6 text-center text-sm bg-red-500 bg-opacity-15 border border-red-500 border-opacity-50 text-red-700 font-semibold';
            } else if (type === 'success') {
                messageDiv.className =
                    'p-4 rounded-lg mb-6 text-center text-sm bg-green-500 bg-opacity-15 border border-green-500 border-opacity-50 text-green-700 font-semibold';
            }
        }

        // Add visual feedback to inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value) {
                    this.classList.remove('border-red-400');
                    this.classList.add('border-green-500');
                } else {
                    this.classList.remove('border-green-500');
                    this.classList.add('border-red-400');
                }
            });
        });

        // Initialize matrix rain
        // createMatrixRain();

        // Handle window resize
        window.addEventListener('resize', function() {
            const canvas = document.querySelector('#matrixBg canvas');
            if (canvas) {
                canvas.remove();
                createMatrixRain();
            }
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('username').value = '';
                document.getElementById('password').value = '';
                document.getElementById('message').classList.add('hidden');
            }
        });
    </script>
</body>

</html>
