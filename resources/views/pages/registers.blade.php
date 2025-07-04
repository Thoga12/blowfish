<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
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
<body class="h-screen flex items-center justify-center">
    <div class="w-full h-full relative overflow-hidden">
        <!-- Background Image -->
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('build/assets/images/backgrounds.png') }}')">
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

            <!-- Login Box -->

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white/20 backdrop-blur-md p-8 rounded-lg shadow-lg">
                    <!-- Nama Input -->
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label class="block text-white mb-2">Nama</label>
                        <input type="text" name="name" placeholder="Masukan Nama" value="{{ old('name') }}"" class="w-full px-4 py-3 rounded border-1 border-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <!-- Email Input -->
                    <div class="mb-6">
                        <label class="block text-white mb-2">Email</label>
                        <input type="email" name="email" placeholder="Masukan Email" value="{{ old('email') }}"" class="w-full px-4 py-3 rounded border-1 border-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label class="block text-white mb-2">Password</label>
                        <input type="password" name="password" placeholder="Masukan Password" class="w-full px-4 py-3 rounded border-1 border-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block mb-1 text-white">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full border-1 px-4 py-3 rounded border-white focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    <!-- Forgot Password -->
                    {{-- <div class="text-right mb-6">
                        <a href="#" class="text-white text-sm hover:underline">Lupa Password?</a>
                    </div> --}}

                    <!-- Login Button -->
                    <button class="w-full bg-blue-500 hover:bg-blue-700 text-white py-3 rounded font-medium transition duration-300">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
