<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Crypto System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet">
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
            opacity: 0.05;
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(239, 68, 68, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(239, 68, 68, 0.02) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: gridFlow 8s linear infinite;
        }

        @keyframes gridFlow {
            0% { background-position: 0 0; }
            100% { background-position: 30px 30px; }
        }

        .glow-card {
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.1);
            transition: all 0.3s ease;
        }

        .glow-card:hover {
            box-shadow: 0 8px 30px rgba(239, 68, 68, 0.2);
            transform: translateY(-2px);
        }

        .glow-card-white {
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .glow-card-white:hover {
            box-shadow: 0 8px 30px rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .stat-counter {
            animation: countUp 2s ease-out;
        }

        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pulse-ring {
            animation: pulseRing 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        @keyframes pulseRing {
            0% { transform: scale(0.8); opacity: 1; }
            80% { transform: scale(1.2); opacity: 0; }
            100% { transform: scale(1.2); opacity: 0; }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .menu-card {
            background: linear-gradient(135deg, rgba(139, 69, 19, 0.8) 0%, rgba(220, 38, 38, 0.3) 100%);
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            border-color: rgba(239, 68, 68, 0.6);
            background: linear-gradient(135deg, rgba(139, 69, 19, 0.9) 0%, rgba(220, 38, 38, 0.4) 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(239, 68, 68, 0.2);
        }

        .menu-card-white {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .menu-card-white:hover {
            border-color: rgba(255, 255, 255, 0.6);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(255, 255, 255, 0.2);
        }

        .status-online {
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .bg-indonesia {
            background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 50%, #ffffff 100%);
        }

        .text-indonesia-red {
            color: #dc2626;
        }

        .text-indonesia-white {
            color: #ffffff;
        }

        .border-indonesia-red {
            border-color: rgba(220, 38, 38, 0.3);
        }

        .border-indonesia-white {
            border-color: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-900 via-red-800 to-white min-h-screen font-mono text-gray-100">
    <!-- Matrix Background -->
    <div class="matrix-bg" id="matrixBg"></div>

    <!-- Grid Overlay -->
    <div class="fixed inset-0 grid-pattern z-10"></div>

    <!-- Main Content -->
    <div class="relative z-20 min-h-screen">
        <!-- Header -->
        <header class="bg-red-900 bg-opacity-80 backdrop-blur-lg border-b border-red-400 border-opacity-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Logo -->
                    <div class="flex items-center space-x-4">
                        <div class="font-orbitron text-2xl font-black text-white">
                            🔐 CRYPTO SYSTEM BLOWFISH
                        </div>
                        <div class="hidden sm:block text-red-300 text-sm opacity-70">
                            Admin Dashboard
                        </div>
                    </div>

                    <!-- User Info & Logout -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-white rounded-full status-online"></div>
                            <span class="text-white text-sm">
                                {{ $users->email }}
                            </span>
                        </div>
                        {{-- <button class="bg-white text-red-900 hover:bg-red-50 px-4 py-2 rounded-lg text-sm font-bold transition-colors duration-200" onclick="logout()">
                            LOGOUTS
                        </button> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-white text-red-900 hover:bg-red-50 px-4 py-2 rounded-lg text-sm font-bold transition-colors duration-200">
                                LOGOUT
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </header>

        <!-- Main Dashboard Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="font-orbitron text-4xl font-black text-white mb-2">
                    Welcome Back, Admin {{ $users->name }}
                </h1>
                <p class="text-red-100 text-lg">
                    <span id="currentTime"></span> | System Status: <span class="text-white font-bold">OPERATIONAL</span>
                </p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Files Processed Today -->
                <div class="glow-card bg-red-900 bg-opacity-80 backdrop-blur-lg p-6 rounded-xl border border-red-400 border-opacity-30">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-300 text-sm font-bold uppercase tracking-wide">Files Today</p>
                            <p class="text-3xl font-orbitron font-black text-white stat-counter" id="filesToday">
                                129
                            </p>
                        </div>
                        <div class="text-red-300 text-4xl floating">
                            📄
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <span class="text-white text-sm">↗ +23% dari kemarin</span>
                    </div>
                </div>

                <!-- Encrypted Files -->
                <div class="glow-card-white bg-white bg-opacity-20 backdrop-blur-lg p-6 rounded-xl border border-white border-opacity-30">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white text-sm font-bold uppercase tracking-wide">Encrypted</p>
                            <p class="text-3xl font-orbitron font-black text-white stat-counter" id="encrypted">
                                1,847
                            </p>
                        </div>
                        <div class="text-white text-4xl floating">
                            🔒
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <span class="text-red-200 text-sm">Total files encrypted</span>
                    </div>
                </div>

                <!-- Decrypted Files -->
                <div class="glow-card bg-red-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-xl border border-red-300 border-opacity-30">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-200 text-sm font-bold uppercase tracking-wide">Decrypted</p>
                            <p class="text-3xl font-orbitron font-black text-white stat-counter" id="decrypted">
                                923
                            </p>
                        </div>
                        <div class="text-red-200 text-4xl floating">
                            🔓
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <span class="text-white text-sm">Total files decrypted</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Menu -->
            <div class="mb-8">
                <h2 class="font-orbitron text-2xl font-bold text-white mb-6">
                    Quick Actions
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Encrypt Files -->
                    <div class="menu-card p-8 rounded-xl cursor-pointer" onclick="navigateTo('encrypt')">
                        <div class="text-center">
                            <div class="text-6xl mb-4 floating">🔐</div>
                            <h3 class="font-orbitron text-xl font-bold text-white mb-2">
                                ENCRYPT FILES
                            </h3>
                            <p class="text-red-200 text-sm mb-4">
                                Secure your files with advanced encryption algorithms
                            </p>
                            <div class="bg-red-500 bg-opacity-30 px-4 py-2 rounded-full text-white text-xs font-bold">
                                BLOWFISH
                            </div>
                        </div>
                    </div>

                    <!-- Decrypt Files -->
                    <div class="menu-card-white p-8 rounded-xl cursor-pointer" onclick="navigateTo('decrypt')">
                        <div class="text-center">
                            <div class="text-6xl mb-4 floating">🔓</div>
                            <h3 class="font-orbitron text-xl font-bold text-white mb-2">
                                DECRYPT FILES
                            </h3>
                            <p class="text-red-100 text-sm mb-4">
                                Restore encrypted files to their original form
                            </p>
                            <div class="bg-white bg-opacity-30 px-4 py-2 rounded-full text-white text-xs font-bold">
                                SECURE DECRYPTION
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mb-8">
                <h2 class="font-orbitron text-2xl font-bold text-white mb-6">
                    Recent Activity
                </h2>
                <div class="bg-red-900 bg-opacity-80 backdrop-blur-lg rounded-xl border border-red-400 border-opacity-30 overflow-hidden">
                    <div class="divide-y divide-red-700">
                        @forelse($logs as $log)
                        <div class="p-4 hover:bg-red-500 hover:bg-opacity-10 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @php
                                        $color = match($log->type) {
                                            'encryption' => 'text-green-400',
                                            'decryption' => 'text-yellow-400',
                                            default => 'text-cyan-400',
                                        };

                                    @endphp
                                    <div class="{{ $color }} text-2xl">
                                        @if($log->type == 'encryption') 🔒
                                    @elseif($log->type == 'decryption') 🔓
                                    @else ℹ️ @endif
                                    </div>
                                    {{-- <div class="text-white text-2xl">🔒</div> --}}
                                    <div>
                                        <p class="text-white font-semibold">{{ $log->file_name }} {{ $log->type }}</p>
                                        {{-- <p class="text-white font-semibold">document.pdf encrypted</p> --}}
                                        {{-- <p class="text-red-200 text-sm">3 minutes ago</p> --}}
                                        <p class="text-gray-400 text-sm">3 minutes ago {{ $log->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-white text-sm font-bold">SUCCESS</div>
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-gray-400">Belum ada aktivitas.</div>
                    @endforelse

                        {{-- <div class="p-4 hover:bg-red-500 hover:bg-opacity-10 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="text-red-200 text-2xl">🔓</div>
                                    <div>
                                        <p class="text-white font-semibold">image.jpg decrypted</p>
                                        <p class="text-red-200 text-sm">15 minutes ago</p>
                                    </div>
                                </div>
                                <div class="text-white text-sm font-bold">SUCCESS</div>
                            </div>
                        </div>

                        <div class="p-4 hover:bg-red-500 hover:bg-opacity-10 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="text-white text-2xl">🔒</div>
                                    <div>
                                        <p class="text-white font-semibold">backup.zip encrypted</p>
                                        <p class="text-red-200 text-sm">32 minutes ago</p>
                                    </div>
                                </div>
                                <div class="text-white text-sm font-bold">SUCCESS</div>
                            </div>
                        </div>

                        <div class="p-4 hover:bg-red-500 hover:bg-opacity-10 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="text-red-200 text-2xl">ℹ️</div>
                                    <div>
                                        <p class="text-white font-semibold">System security scan completed</p>
                                        <p class="text-red-200 text-sm">1 hour ago</p>
                                    </div>
                                </div>
                                <div class="text-white text-sm font-bold">CLEAN</div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Matrix Rain Effect (Red theme)
        function createMatrixRain() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            document.getElementById('matrixBg').appendChild(canvas);

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const chars = '01ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const charArray = chars.split('');
            const fontSize = 12;
            const columns = canvas.width / fontSize;
            const drops = Array(Math.floor(columns)).fill(1);

            function draw() {
                ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
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

            setInterval(draw, 50);
        }

        // Update current time
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('currentTime').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Animate counters
        function animateCounters() {
            const counters = ['filesToday', 'encrypted', 'decrypted'];
            // const targets = [129, 1847, 923];
            const targets = [
        {{ $totalToday ?? 0 }},
        {{ $totalEncrypted ?? 0 }},
        {{ $totalDecrypted ?? 0 }}
    ];

            counters.forEach((id, index) => {
                const element = document.getElementById(id);
                const target = targets[index];
                let current = 0;
                const increment = target / 50;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current).toLocaleString();
                    }
                }, 30);
            });
        }

        // Navigation functions
        function navigateTo(page) {
            // Add click animation
            event.currentTarget.style.transform = 'scale(0.95)';
            setTimeout(() => {
                event.currentTarget.style.transform = '';
            }, 150);

            // Simulate navigation
            setTimeout(() => {
                switch(page) {
                    case 'encrypt':
                        alert('Navigating to Encryption page...\nURL: /encrypt');
                        window.location.href = '/enkripsi';
                        break;
                    case 'decrypt':
                        alert('Navigating to Decryption page...\nURL: /decrypt');
                        window.location.href = '/dekripsi';
                        break;
                    case 'history':
                        alert('Navigating to History page...\nURL: /history');
                        window.location.href = '/logsss';
                        break;
                }
            }, 200);
        }

        // function logout() {
        //     if (confirm('Are you sure you want to logout?')) {
        //         alert('Logging out...\nRedirecting to login page.');
        //         // window.location.href = '/login';
        //     }
        // }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // createMatrixRain();
            updateTime();
            animateCounters();

            // Update time every minute
            setInterval(updateTime, 60000);
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const canvas = document.querySelector('#matrixBg canvas');
            if (canvas) {
                canvas.remove();
                createMatrixRain();
            }
        });

        // Add some real-time updates simulation
        setInterval(() => {
            // Randomly update some stats
            if (Math.random() > 0.7) {
                const filesToday = document.getElementById('filesToday');
                const current = parseInt(filesToday.textContent);
                filesToday.textContent = current + 1;
            }
        }, 10000);
    </script>
</body>
</html>
