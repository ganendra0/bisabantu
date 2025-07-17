<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Donasi Sosial - Ulurkan Tangan, Ubah Kehidupan')</title>
    
    {{-- Menggunakan helper asset() untuk memanggil file CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Stack untuk menambahkan CSS spesifik per halaman --}}
    @stack('styles')
</head>
<body>
    {{-- Menyertakan komponen header --}}
    @include('partials.header')

    <main>
        {{-- Konten utama halaman akan dimuat di sini --}}
        @yield('content')
    </main>

    {{-- Menyertakan komponen footer --}}
    @include('partials.footer')

    {{-- Menggunakan helper asset() untuk memanggil file JavaScript --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Stack untuk menambahkan JavaScript spesifik per halaman --}}
    @stack('scripts')
</body>
</html>