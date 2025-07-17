{{-- Menggunakan layout utama yang sudah kita buat --}}
@extends('layouts.app')

{{-- Menetapkan judul halaman --}}
@section('title', 'Dukung Kampanye Kami - Donasi Sosial')

{{-- Konten utama halaman kampanye --}}
@section('content')
<section id="campaigns" class="campaigns-section">
    <div class="container">
        {{-- Bagian header dari template statis --}}
        <div class="section-header">
            <div class="tag">Kampanye Kami</div>
            <h2 class="kampanye-section-title">Dukung Inisiatif Kami</h2>
            <p class="kampanye-section-description">Setiap donasi, sekecil apapun, memberikan dampak besar. Pilih kampanye yang ingin Anda dukung.</p>
        </div>

        {{-- Grid untuk menampung semua kartu kampanye --}}
        <div class="campaigns-grid" id="campaigns-grid">

            {{--
                LOOPING DINAMIS:
                Mengambil logika dari kode dinamis Anda (@foreach) untuk menampilkan setiap kampanye.
                Pastikan Controller Anda mengirimkan variabel bernama $donations.
            --}}
            @forelse ($donations as $donation)
                
                {{-- MENGGUNAKAN STRUKTUR KARTU DARI TEMPLATE STATIS --}}
                <div class="campaign-card" id="animated-card-{{ $loop->index }}">
                    
                    {{-- Gambar dinamis --}}
                    <img src="{{ asset('uploads/' . $donation->gambar) }}" width="400" height="225" alt="Gambar Kampanye: {{ $donation->name }}" class="campaign-image">
                    
                    <div class="card-header">
                        {{-- Judul dinamis --}}
                        <h3 class="card-title">{{ $donation->name }}</h3>
                        {{-- Deskripsi dinamis, dengan pesan default jika kosong --}}
                        <p class="card-description">{{ $donation->message ?: 'Mari bersama-sama membantu mereka yang membutuhkan.' }}</p>
                    </div>

                    <div class="card-content">
                        {{-- Teks progres dinamis --}}
                        <div class="progress-text">
                            Terkumpul: Rp{{ number_format($donation->total_terkumpul, 0, ',', '.') }} dari Rp{{ number_format($donation->target, 0, ',', '.') }}
                        </div>
                        <div class="progress-bar-container">
                            {{-- Logika progress bar dinamis --}}
                            @php
                                $persentase = $donation->target > 0 ? ($donation->total_terkumpul / $donation->target) * 100 : 0;
                                $persentase = min($persentase, 100);
                            @endphp
                            <div class="progress-bar" style="width: {{ $persentase }}%;"></div>
                        </div>
                        {{-- Tambahan: Tampilkan jumlah donatur jika ingin --}}
                        <p class="donatur-count">
                            <i class="fa-regular fa-circle-check"></i> {{ $donation->donaturs->count() }} Orang Telah Berdonasi
                        </p>
                    </div>

                    <div class="card-footer">
                        {{-- Tombol donasi dinamis --}}
                        <a href="/pembayaran?donation_id={{ $donation->id }}" class="btn btn-primary w-full">Donasi Sekarang</a>
                    </div>
                </div>

            @empty
                {{-- Pesan jika tidak ada kampanye yang ditemukan --}}
                <p>Saat ini belum ada kampanye yang tersedia untuk didukung.</p>
            @endforelse

        </div>
    </div>
</section>
@endsection


{{-- MENAMBAHKAN CSS SPESIFIK: Mengambil style dari kode dinamis Anda --}}
@push('styles')
<style>
    /* Menambahkan style khusus untuk kartu yang dinamis */
    .campaign-card#animated-card-0,
    .campaign-card#animated-card-1,
    .campaign-card#animated-card-2, 
    .campaign-card { /* Fallback untuk semua kartu */
        animation: scrollUp 1s ease-in-out forwards;
        opacity: 0;
    }
    
    /* Delay animasi agar muncul satu per satu */
    .campaign-card#animated-card-1 { animation-delay: 0.2s; }
    .campaign-card#animated-card-2 { animation-delay: 0.4s; }
    /* ...tambahkan jika perlu... */

    @keyframes scrollUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .donatur-count {
        font-size: 0.8rem;
        color: #666;
        margin-top: 10px;
    }

    .donatur-count .fa-circle-check {
        margin-right: 5px;
        color: #28a745; /* Warna hijau untuk ikon cek */
    }

    /* Anda bisa memindahkan style ini ke file style.css utama jika diinginkan */
</style>
@endpush