@extends('layouts.apps')

@section('title', 'Tentang Destinasi - Wisata Sulawesi Tenggara')

@section('content')

{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Sulawesi Tenggara</title>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}

{{-- </head> --}}
{{-- <body class="bg-gray-800 text-gray-200"> --}}

    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        {{-- <nav class="bg-blue-600 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="#" class="text-white text-xl font-bold">Wisata Sulawesi Tenggara</a>
                <div class="space-x-4">
                    <a href="#" class="text-white">Home</a>
                    <a href="#" class="text-white">Destinasi</a>
                    <a href="#" class="text-white">Rekomendasi</a>
                    <a href="#" class="text-white">Tentang</a>
                    <a href="#" class="text-white">Kontak</a>
                </div>
                <div class="space-x-2">
                    <a href="#" class="text-white">Login</a>
                    <a href="#" class="text-white">Register</a>
                </div>
            </div>
        </nav> --}}

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="container mx-auto p-6 bg-white text-black rounded-lg shadow-lg my-8">
                <h1 class="text-3xl font-bold text-center mb-6">Sistem Rekomendasi Destinasi Wisata Sulawesi Tenggara Berbasis Website</h1>

                <p class="text-center mb-12 text-lg">
                    Platform kami menggunakan teknologi algoritma item-based collaborative filtering untuk merekomendasikan destinasi wisata terbaik berdasarkan preferensi pengguna.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <!-- Fitur 1 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold mb-2">Destinasi Unik</h2>
                        <p>Temukan tempat wisata tersembunyi yang belum banyak diketahui.</p>
                    </div>

                    <!-- Fitur 2 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold mb-2">Navigasi Mudah</h2>
                        <p>Akses peta dan panduan perjalanan yang lengkap.</p>
                    </div>

                    <!-- Fitur 3 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold mb-2">Rekomendasi</h2>
                        <p>Dapatkan saran wisata sesuai minat dan ulasan pengguna lain.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 py-6">
            <div class="container mx-auto text-center">
                <p>&copy; 2025 Wisata Sulawesi Tenggara. All rights reserved.</p>
            </div>
        </footer>
    </div>
@endsection
{{-- </body>
</html> --}}
