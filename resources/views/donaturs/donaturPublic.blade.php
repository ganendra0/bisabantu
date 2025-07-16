@extends('layouts.header')
@section('title', 'Daftar Donatur')
{{-- LIST DONATUR PUBLIK --}}

@section('content')
    <div class="container mt-5">
        <span class="fade-in">
            <h1 class="text-center mb-4" id="gradient">
                <i class="fa-solid fa-envelope-open-text"></i>
                Daftar Donatur
            </h1>
        </span>

        <div class="container mb-5">
    <h2 class="text-center font-bold text-lg mb-3">🏆 Top Donatur</h2>
    <ol class="list-decimal pl-5 leaderboard-list">
        @forelse ($leaderboard as $index => $top)
            <li class="mb-1">
                <strong>{{ $top->nama }}</strong> –
                <span class="text-green-500">Rp {{ number_format($top->total_donasi, 0, ',', '.') }}</span>
            </li>
        @empty
            <p class="text-center">Belum ada donatur.</p>
        @endforelse
    </ol>
</div>

<form method="GET" action="{{ route('donaturs.public') }}" class="mb-4 text-center">
    <label for="donation_id">Lihat Donatur untuk Kampanye:</label>
    <select name="donation_id" id="donation_id" onchange="this.form.submit()" class="ml-2 p-1 rounded">
    <option value="">-- Semua Kampanye --</option>
    @foreach ($donations as $donation)
        <option value="{{ $donation->id }}">
    {{ $donation->name }}  {{-- ✅ sesuai kolom DB --}}
</option>

    @endforeach
</select>
</form>

@if ($donationSelected)
    <h3 class="text-center text-lg font-semibold mt-4">
        Menampilkan Donatur untuk Kampanye: <span class="text-blue-600">{{ $donationSelected->name }}</span>
    </h3>
@endif



        @if ($donaturs->isEmpty())
            <p class="text-center">Belum ada donatur.</p>
        @else
            @foreach ($donaturs as $donatur)
                <div class="card mb-3">
                    <div class="header">
                        <img src="https://i.ibb.co.com/nQQmMw8/ikonrupiah.png" class="image" />
                        <div>
                            <p class="name">{{ $donatur->nama }}</p>
                            <p class="amount">
                                <span class="donation-amount">Rp
                                    {{ number_format($donatur->total_donasi, 0, ',', '.') }}</span>
                                <span class="via-method"><i class="fa-solid fa-circle"></i> Via
                                    {{ $donatur->tipe_bayar }}</span>
                            </p>
                            <p class="message">{{ $donatur->pesan }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <style>
        #gradient {
            font-weight: 600;
            background: linear-gradient(to right,
                    #5374cd 20%,
                    #00affa 30%,
                    #0a92ec 70%,
                    #4a64da 80%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-fill-color: transparent;
            background-size: 500% auto;
            animation: textShine 5s ease-in-out infinite alternate;
        }

        @keyframes textShine {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 1.2s ease-in-out;
        }

        .fa-envelope-open-text {
            font-size: 1.7rem;
            margin-right: 1rem;
            vertical-align: 15%;
        }

        .amount {
            font-size: 1rem;
            font-weight: 600;
        }

        .donation-amount {
            color: #22c55e;
            /* Hijau */
        }

        .via-method {
            color: rgba(107, 114, 128, 1);
            /* Abu-abu */
            font-weight: 400;
        }

        .fa-circle {
            font-size: 0.3rem;
            padding: 0.5rem;
            vertical-align: middle;
            color: rgb(200, 206, 217);
        }

        .card {
            background-color: rgba(243, 244, 246, 1);
            padding: 1rem;
            max-width: 1100px;
            border-radius: 30px;
            box-shadow: 0 20px 30px -20px rgba(5, 5, 5, 0.24);
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1.5s forwards;
        }

        .header {
            display: flex;
            align-items: center;
            grid-gap: 1rem;
            gap: 1rem;
        }

        .header .image {
            height: 4rem;
            width: 4rem;
            border-radius: 9999px;
            object-fit: cover;
            margin-left: 1rem;
            margin-right: 0.7rem;
            /* background-color: royalblue; */
        }

        .name {
            margin-top: 0.1rem;
            margin-bottom: 0.1rem;
            font-size: 1.5rem;
            line-height: 1.75rem;
            font-weight: 600;
            color: rgba(55, 65, 81, 1);
        }

        .message {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            margin-top: -0.5rem;
            color: rgba(107, 114, 128, 1);
        }


        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .leaderboard-list {
    background: #f9fafb;
    padding: 1rem 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    max-width: 600px;
    margin: 0 auto 2rem;
    font-size: 1rem;
    color: #374151;
}

    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>



    </html>
@endsection
