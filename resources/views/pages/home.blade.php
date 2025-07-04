<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Sulawesi Tenggara</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-heading {
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .rain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .drop {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            width: 1px;
            height: 20px;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px);
            }
            100% {
                transform: translateY(100vh);
            }
        }

        .drop:nth-child(1) { left: 5%; animation-duration: 1.5s; animation-delay: 0s; }
        .drop:nth-child(2) { left: 10%; animation-duration: 1.8s; animation-delay: 0.2s; }
        .drop:nth-child(3) { left: 15%; animation-duration: 1.6s; animation-delay: 0.4s; }
        .drop:nth-child(4) { left: 20%; animation-duration: 1.9s; animation-delay: 0.1s; }
        .drop:nth-child(5) { left: 25%; animation-duration: 1.7s; animation-delay: 0.3s; }
        .drop:nth-child(6) { left: 30%; animation-duration: 1.5s; animation-delay: 0.5s; }
        .drop:nth-child(7) { left: 35%; animation-duration: 1.8s; animation-delay: 0.2s; }
        .drop:nth-child(8) { left: 40%; animation-duration: 1.6s; animation-delay: 0.4s; }
        .drop:nth-child(9) { left: 45%; animation-duration: 1.9s; animation-delay: 0.1s; }
        .drop:nth-child(10) { left: 50%; animation-duration: 1.7s; animation-delay: 0.3s; }
        .drop:nth-child(11) { left: 55%; animation-duration: 1.5s; animation-delay: 0.5s; }
        .drop:nth-child(12) { left: 60%; animation-duration: 1.8s; animation-delay: 0.2s; }
        .drop:nth-child(13) { left: 65%; animation-duration: 1.6s; animation-delay: 0.4s; }
        .drop:nth-child(14) { left: 70%; animation-duration: 1.9s; animation-delay: 0.1s; }
        .drop:nth-child(15) { left: 75%; animation-duration: 1.7s; animation-delay: 0.3s; }
        .drop:nth-child(16) { left: 80%; animation-duration: 1.5s; animation-delay: 0.5s; }
        .drop:nth-child(17) { left: 85%; animation-duration: 1.8s; animation-delay: 0.2s; }
        .drop:nth-child(18) { left: 90%; animation-duration: 1.6s; animation-delay: 0.4s; }
        .drop:nth-child(19) { left: 95%; animation-duration: 1.9s; animation-delay: 0.1s; }
        .drop:nth-child(20) { left: 98%; animation-duration: 1.7s; animation-delay: 0.3s; }
    </style>
</head>
<body>
    {{-- <div class="relative w-full min-h-screen bg-gradient-to-b from-blue-900 to-blue-700 overflow-hidden"> --}}
    <div class="w-full h-full relative bg-cover bg-center" style="background-image: url('{{ asset('build/assets/images/backgrounds.png') }}')">

        <!-- Rain Effect -->
        <div class="rain">
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
            <div class="drop"></div>
        </div>

        <!-- Navigation Bar -->
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-white text-xl font-semibold">Wisata Sulawesi Tenggara</a>
            </div>

            <div class="flex items-center space-x-8">
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-white hover:text-blue-200 transition duration-300">Home</a>
                    <a href="{{ route('destinasi') }}" class="text-white hover:text-blue-200 transition duration-300">Destinasi</a>
                    <a href="{{ route('rekomedasi') }}" class="text-white hover:text-blue-200 transition duration-300">Rekomendasi</a>
                    <a href="{{ route('tentang') }}" class="text-white hover:text-blue-200 transition duration-300">Tentang</a>
                    {{-- <a href="#" class="text-white hover:text-blue-200 transition duration-300">Kontak</a> --}}
                </div>
                {{-- @auth

                @endauth --}}
                @guest

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('logins') }}" class="text-white hover:text-blue-200 transition duration-300">Login</a>
                        <a href="{{ route('register') }}" class="text-white hover:text-blue-200 transition duration-300">Register</a>
                    </div>
                @endguest
                @auth

                    <div class="flex items-center space-x-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"  class="text-white hover:text-blue-200 transition duration-300">Log Out</button>
                        </form>
                        {{-- <a href="{{ route('register') }}" class="text-white hover:text-blue-200 transition duration-300">Register</a> --}}
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="container mx-auto px-6 relative z-10 flex flex-col h-screen justify-center">
            {{-- <div class="absolute inset-0 flex justify-center items-center z-0">
                <img src="/api/placeholder/1440/894" alt="Pantai Sulawesi Tenggara" class="w-full h-full object-cover">
            </div> --}}

            <div class="relative z-10 text-center">
                <h1 class="hero-heading text-white text-4xl md:text-6xl font-bold mb-4 leading-tight">
                    Temukan Destinasi Terbaik<br />Di Sulawesi Tenggara
                </h1>
            </div>
        </div>

        <!-- Overlay for image -->
        {{-- <div class="absolute inset-0 bg-blue-900/30 z-0"></div> --}}
    </div>
</body>
</html>
