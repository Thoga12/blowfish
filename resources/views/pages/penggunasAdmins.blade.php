@extends('layouts.appsAdmins')

@section('title', 'Kelola Pengguna Users   ')

@section('content')

    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Wisata</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}

{{-- <body class="bg-gray-100"> --}}
    <div class="min-h-screen">
        <!-- Header -->
        {{-- <header class="bg-white shadow-sm border-b">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Left side with hamburger menu and navigation -->
                    <div class="flex items-center space-x-8">
                        <button class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <!-- Navigation Tabs -->
                        <nav class="flex space-x-8">
                            <a href="#" class="text-gray-600 hover:text-gray-900 pb-2">Dashboard</a>
                            <a href="#" class="text-gray-600 hover:text-gray-900  pb-2 font-medium">Wisata</a>
                            <a href="#" class="text-gray-600 hover:text-gray-900 pb-2">Kategori</a>
                            <a href="#" class="text-blue-600 border-blue-600 border-b-2 hover:text-gray-900 pb-2">Pengguna</a>
                        </nav>
                    </div>

                    <!-- Right side with profile -->
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                    </div>
                </div>
            </div>
        </header> --}}

        <!-- Main Content -->
        <main class="p-6">
            <div class="bg-white rounded-lg shadow-sm">
                <!-- Page Title -->
                <div class="px-6 py-4 border-b">
                    <h1 class="text-2xl font-bold text-gray-900">Wisata</h1>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                 @endif
                <!-- Action Buttons -->
                <div class="px-6 py-4 border-b">
                    <div class="flex space-x-3">
                        <button  id="btnTambahPenggunas" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Pengguna
                        </button>
                        {{-- <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Kategori
                        </button> --}}
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">

                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                    Nama Pengguna
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                    Role
                                </th>
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                    Latitude
                                </th> --}}
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                    Longitude
                                </th> --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample data rows -->
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    {{ $user->email }}

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 border-r">
                                    {{-- <div class="max-w-xs truncate">
                                        Pantai dengan pasir putih dan air jernih yang menawarkan pemandangan sunset yang indah
                                    </div> --}}
                                    {{ $user->role }}

                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    -3.9778
                                </td> --}}
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    122.5194
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('users.edit' , $user->id) }}">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus destinasi?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                            {{-- <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    Air Terjun Moramo
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    Konawe Selatan
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 border-r">
                                    <div class="max-w-xs truncate">
                                        Air terjun bertingkat yang eksotis dengan air jernih dan suasana alami yang asri
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    -4.1234
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    121.9876
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr> --}}

                            {{-- <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    Pulau Bokori
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    Konawe
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 border-r">
                                    <div class="max-w-xs truncate">
                                        Pulau kecil dengan jembatan kayu dan spot foto instagramable yang menarik
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    -3.8567
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r">
                                    122.4321
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>

                <!-- Empty state message if no data -->
                <div class="px-6 py-8 text-center text-gray-500 hidden" id="emptyState">
                    <i class="fas fa-map-marker-alt text-4xl mb-4"></i>
                    <p class="text-lg mb-2">Belum ada data wisata</p>
                    <p class="text-sm">Klik tombol "Tambah Wisata" untuk menambah destinasi wisata baru</p>
                </div>
            </div>
        </main>
    </div>

    <div id="modalTambahPenggunas" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 bg-opacity-10">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
                    Tambah Pengguna Baru
                </h3>
                <button id="btnCloseModal" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="formTambahPenngunas" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">

                    <!-- Nama Destinasi -->
                    <div>
                        <label for="nama_destinasi" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i>
                            Nama Destinasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_destinasi" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan nama destinasi wisata">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-location-dot text-blue-600 mr-1"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan email">
                    </div>

                    <!-- Deskripsi -->
                    {{-- <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left text-blue-600 mr-1"></i>
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" name="description" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Deskripsikan destinasi wisata dengan detail..."></textarea>
                    </div> --}}

                    <!-- Koordinat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-globe text-blue-600 mr-1"></i>
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" name="password" step="any" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukan password">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-globe text-blue-600 mr-1"></i>
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" step="any" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: 122.5194">
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    {{-- <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-camera text-blue-600 mr-1"></i>
                            Gambar Destinasi
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload gambar</span>
                                        <input id="gambar" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Kategori -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags text-blue-600 mr-1"></i>
                            Role
                        </label>
                        <select id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Kategori</option>
                            <option value="user">Users</option>
                            <option value="role">Admin</option>
                            {{-- <option value="role">Air Terjun</option>
                            <option value="4">Pulau</option>
                            <option value="5">Budaya</option>
                            <option value="6">Kuliner</option> --}}
                        </select>
                    </div>

                    <!-- Fasilitas -->
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-concierge-bell text-blue-600 mr-1"></i>
                            Fasilitas yang Tersedia
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="fasilitas[]" value="parking" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Parkir</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="fasilitas[]" value="toilet" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Toilet</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="fasilitas[]" value="restaurant" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Restoran</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="fasilitas[]" value="guide" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Pemandu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="fasilitas[]" value="wifi" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">WiFi</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="fasilitas[]" value="souvenir" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Toko Souvenir</span>
                            </label>
                        </div>
                    </div> --}}

                    <!-- Jam Operasional -->
                    {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="jam_buka" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clock text-blue-600 mr-1"></i>
                                Jam Buka
                            </label>
                            <input type="time" id="jam_buka" name="jam_buka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="jam_tutup" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clock text-blue-600 mr-1"></i>
                                Jam Tutup
                            </label>
                            <input type="time" id="jam_tutup" name="jam_tutup"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div> --}}

                    <!-- Harga Tiket -->
                    {{-- <div>
                        <label for="harga_tiket" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-ticket-alt text-blue-600 mr-1"></i>
                            Harga Tiket (Rp)
                        </label>
                        <input type="number" id="harga_tiket" name="harga_tiket" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan harga tiket (kosongkan jika gratis)">
                    </div> --}}

                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end space-x-3 p-6 border-t bg-gray-50">
                    <button type="button" id="btnBatal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-1"></i>
                        Simpan Penggunas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalTambahPenggunas');
            const btnTambah = document.getElementById('btnTambahPenggunas');
            const btnClose = document.getElementById('btnCloseModal');
            const btnBatal = document.getElementById('btnBatal');
            const form = document.getElementById('formTambahPenggunas');

            // Buka modal
            btnTambah.addEventListener('click', function() {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });

            // Tutup modal
            function closeModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                form.reset();
            }

            btnClose.addEventListener('click', closeModal);
            btnBatal.addEventListener('click', closeModal);

            // Tutup modal jika klik di luar
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Preview gambar yang diupload
            // document.getElementById('gambar').addEventListener('change', function(e) {
            //     const file = e.target.files[0];
            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = function(e) {
            //             // Bisa tambahkan preview gambar di sini
            //             console.log('File uploaded:', file.name);
            //         };
            //         reader.readAsDataURL(file);
            //     }
            // });

            // Validasi form sebelum submit
            form.addEventListener('submit', function(e) {
                const requiredFields = ['name', 'email', 'password', 'password_confirmations', 'roles'];
                let isValid = true;

                requiredFields.forEach(function(fieldName) {
                    const field = document.getElementById(fieldName);
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi!');
                }
            });
        });
    </script>
@endsection

