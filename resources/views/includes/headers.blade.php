<nav class="bg-blue-600 text-white py-4">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <div class="flex items-center">
            <a href="/" class="text-white text-xl font-semibold">Wisata Sulawesi Tenggara</a>
        </div>

        <div class="flex items-center">
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-white hover:text-blue-200 transition duration-300">Home</a>
                <a href="{{ route('destinasi') }}" class="text-white hover:text-blue-200 transition duration-300">Destinasi</a>
                <a href="/rekomendasi" class="text-white hover:text-blue-200 transition duration-300">Rekomendasi</a>
                <a href="{{ route('tentang') }}" class="text-white hover:text-blue-200 transition duration-300">Tentang</a>
                @auth
                 @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="text-white hover:text-blue-200 transition duration-300">Dashboard </a>
                    {{-- <div class="flex items-center space-x-4"> --}}
                        {{-- <a href="{{ route('logins') }}" class="text-white hover:text-blue-200 transition duration-300">Log Out</a> --}}
                        {{-- <a href="{{ route('register') }}" class="text-white hover:text-blue-200 transition duration-300">Register</a> --}}
                    {{-- </div> --}}
                 @endif
                @endauth
            </div>
        </div>
        @guest
            <div class="flex items-center space-x-4">
                <a href="{{ route('logins') }}" class="text-white hover:text-blue-200 transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:text-blue-200 transition duration-300">Register</a>
            </div>
        @endguest
    </div>
</nav>
