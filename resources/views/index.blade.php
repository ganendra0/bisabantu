@extends('layouts.app')

@section('title', 'Beranda - Donasi Sosial')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Ulurkan Tangan, Ubah Kehidupan</h1>
                <p class="hero-description">Bersama kita bisa menciptakan dampak positif yang nyata bagi masyarakat yang membutuhkan.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="redirectDonasi()">
                        <span class="shadow"></span>
                        <span class="edge"></span>
                        <span class="front">Mulai Donasi</span>
                </button>
                <script>
        function redirectDonasi() {
            window.location.href = "/donasi";
        }
    </script>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container about-content">
            {{-- Path sudah benar menunjuk ke 'public/images/index/tentang-kami.png' --}}
            {{-- Nama file telah diperbaiki untuk menghilangkan spasi --}}
            <img src="{{ asset('images/index/tentang-kami.png') }}" width="550" height="310" alt="Tentang Kami" class="about-image">
            <div class="about-text">
                <div class="tag">Tentang Kami</div>
                <h2 class="section-title">Misi Kami: Membangun Komunitas yang Lebih Baik</h2>
                <p class="section-description">Kami adalah organisasi nirlaba yang berkomitmen membangun masa depan lebih baik bagi masyarakat kurang 
                    beruntung melalui program donasi, pendidikan, dan aksi sosial yang berkelanjutan. Bersama para donatur dan relawan, kami percaya bahwa setiap aksi kebaikan, 
                    sekecil apa pun, 
                    dapat menciptakan perubahan besar dan membangun komunitas yang lebih peduli dan berdaya.</p>
            </div>
        </div>
    </section>
    
    <!-- Call to Action Section -->
    
@endsection