@extends('layouts.app')
@section('title', 'Login')

{{-- Menambahkan CSS khusus untuk halaman login --}}
@push('styles')
<style>
    /* 1. WADAH UNTUK MENGATUR POSISI FORM DI TENGAH LAYAR */
    .login-container {
        display: flex;
        align-items: center; /* Membuat form di tengah secara vertikal */
        justify-content: center; /* Membuat form di tengah secara horizontal */
        
        /* Mengisi sisa ruang layar di bawah navbar */
        /* Ganti 72px dengan tinggi navbar Anda yang sebenarnya! */
        min-height: calc(100vh - 72px); 
        padding: 2rem 1rem; /* Beri sedikit padding untuk layar kecil */
    }

    /* 2. STYLE FORM LOGIN ANDA (TIDAK ADA PERUBAHAN BESAR) */
    .form {
        position: relative;
        display: flex;
        flex-direction: column;
        border-radius: 0.75rem;
        background-color: #fff;
        color: rgb(97 97 97);
        box-shadow: 0 20px 30px -15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 22rem; /* Batasi lebar maksimum form */
        background-clip: border-box;
        animation: scrollUp 1s ease-in-out forwards;
    }

    @keyframes scrollUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .form .header {
        position: relative;
        background-clip: border-box;
        background-color: #1e88e5;
        background-image: linear-gradient(to top right, #1e88e5, #42a5f5);
        margin: 10px;
        border-radius: 0.75rem;
        overflow: hidden;
        color: #fff;
        box-shadow: 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 0 #0000, rgba(33, 150, 243, .4);
        height: 7rem;
        letter-spacing: 0;
        line-height: 1.375;
        font-weight: 600;
        font-size: 1.9rem;
        font-family: Roboto, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form .inputs {
        padding: 1.5rem;
        gap: 1rem;
        display: flex;
        flex-direction: column;
    }

    .form .input {
        border: 1px solid rgba(128, 128, 128, 0.61);
        outline: 0;
        color: rgb(69 90 100);
        font-weight: 400;
        font-size: .9rem;
        line-height: 1.25rem;
        padding: 0.75rem;
        background-color: transparent;
        border-radius: .375rem;
        width: 100%;
    }

    .form .input:focus {
        border: 1px solid #1e88e5;
    }

    .form .sigin-btn {
        text-transform: uppercase;
        font-weight: 700;
        font-size: .75rem;
        line-height: 1rem;
        text-align: center;
        padding: .75rem 1.5rem;
        background-color: #1e88e5;
        background-image: linear-gradient(to top right, #1e88e5, #42a5f5);
        border-radius: .5rem;
        width: 100%;
        outline: 0;
        border: 0;
        color: #fff;
        cursor: pointer;
    }

    /* 3. FIX UNTUK CLASS .text-center YANG TIDAK BERFUNGSI LAGI */
    .form p {
        text-align: center;
        padding: 0 1.5rem 1.5rem;
        margin: 0;
        font-size: 0.9em;
    }
</style>
@endpush


@section('content')
    {{-- Mengganti div lama dengan wadah baru --}}
    <div class="login-container">
        <form class="form" action="/session/login" method="POST">
            @csrf
            <div class="header">Masuk</div>
            <div class="inputs">
                @if($errors->any())
                <div style="color: #e74c3c; margin-bottom: 10px; text-align: center;">
                    {{ $errors->first('loginError') }}
                </div>
                @endif
                
                @if(session('success'))
                <div style="color: #2ecc71; margin-bottom: 10px; text-align: center;">
                    {{ session('success') }}
                </div>
                @endif
                
                <input name="username" placeholder="Username" class="input" type="text" required
                    value="{{ old('username') }}">
                <input name="password" placeholder="Password" class="input" type="password" required>
                <button name="submit" type="submit" class="sigin-btn">Login</button>
            </div>
            {{-- Class 'text-center' sekarang di-handle oleh CSS di atas --}}
            <p>Belum punya akun? <a href="/session/register">Daftar disini</a></p>
        </form>
    </div>
@endsection