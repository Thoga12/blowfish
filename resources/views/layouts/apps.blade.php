<!-- resources/views/layouts/apps.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIMK')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSS (Bootstrap atau Tailwind bisa ditambahkan sesuai kebutuhan) -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- resources/views/dashborad.blade.php --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-heading {
            font-family: 'Playfair Display', serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-900">
    {{-- <div class="flex h-screen"> --}}

        <!-- Navbar -->
        @include('includes.headers')

        <!-- Main Content -->
        <main class="container mx-auto py-6 px-4">
            @yield('content')
        </main>
    {{-- </div> --}}

        <!-- Footer -->
        {{-- @include('partials.footer') --}}
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
</body>
</html>
