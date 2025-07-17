@extends('layouts.app')
@section('title', 'Daftar Donatur')

@push('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        /* Judul halaman */
        .gradient-title {
            font-weight: 600;
            background: linear-gradient(to right, #5374cd, #00affa, #0a92ec, #4a64da);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 500% auto;
            animation: textShine 5s ease-in-out infinite alternate;
        }

        @keyframes textShine {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .title-icon {
            font-size: 1.7rem;
            margin-right: 1rem;
        }

        /* Leaderboard */
        .leaderboard-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .leaderboard-list {
            list-style: none;
            padding: 0;
        }

        .leaderboard-item {
            padding: 10px 15px;
            border-bottom: 1px solid #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .leaderboard-item:last-child {
            border-bottom: none;
        }

        .donor-name {
            font-weight: 600;
            color: #343a40;
        }

        .donation-amount {
            color: #28a745;
            font-weight: 600;
        }

        /* Filter */
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .filter-select {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 8px 12px;
        }

        .filter-select:focus {
            border-color: #5374cd;
            box-shadow: 0 0 0 2px rgba(83, 116, 205, 0.25);
        }

        /* Campaign info */
        .campaign-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }

        /* Kartu donatur */
        .donatur-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s forwards;
        }

        .donatur-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .donatur-avatar {
            width: 100px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #e9ecef;
        }

        .donatur-name {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 5px;
        }

        .donatur-amount {
            color: #28a745;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .payment-method {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .payment-dot {
            font-size: 0.4em;
            vertical-align: middle;
            margin: 0 0.5em;
        }

        .donatur-message {
            color: #6c757d;
            font-style: italic;
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gradient-title {
                font-size: 1.8rem;
            }
            
            .filter-section {
                padding: 15px;
            }
            
            .donatur-card .card-body {
                padding: 15px;
            }
        }
    </style>
@endpush

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="text-center mb-4">
        <h1 class="gradient-title">
            <i class="fa-solid fa-envelope-open-text title-icon"></i>
            Daftar Donatur
        </h1>
    </div>

    <!-- Leaderboard -->
    <div class="card leaderboard-card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold mb-3">
                <i class="fas fa-trophy text-warning"></i> Top Donatur
            </h4>
            <ol class="leaderboard-list">
                @forelse ($leaderboard as $index => $top)
                    <li class="leaderboard-item">
                        <span class="donor-name">{{ $loop->iteration }}. {{ $top->nama }}</span>
                        <span class="donation-amount">Rp {{ number_format($top->total_donasi, 0, ',', '.') }}</span>
                    </li>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <p>Belum ada donatur.</p>
                    </div>
                @endforelse
            </ol>
        </div>
    </div>

    <!-- Filter -->
    <div class="filter-section">
        <form method="GET" action="{{ route('donaturs.public') }}">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <label for="donation_id" class="font-weight-medium mb-2">
                        <i class="fas fa-filter"></i> Lihat donatur untuk kampanye:
                    </label>
                    <select name="donation_id" id="donation_id" class="form-control filter-select" onchange="this.form.submit()">
                        <option value="">-- Semua Kampanye --</option>
                        @foreach ($donations as $donation)
                            <option value="{{ $donation->id }}" {{ $donationSelected && $donationSelected->id == $donation->id ? 'selected' : '' }}>
                                {{ $donation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Campaign Info -->
    @if ($donationSelected)
        <div class="campaign-info">
            <h5 class="mb-0">
                <i class="fas fa-bullseye"></i>
                Menampilkan donatur untuk: <strong>{{ $donationSelected->name }}</strong>
            </h5>
        </div>
    @endif

    <!-- Daftar Donatur -->
    @forelse ($donaturs as $donatur)
        <div class="card donatur-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="https://i.ibb.co.com/nQQmMw8/ikonrupiah.png" class="donatur-avatar" alt="Avatar Donatur"/>
                    </div>
                    <div class="col">
                        <h5 class="donatur-name">{{ $donatur->nama }}</h5>
                        <div class="mb-2">
                            <span class="donatur-amount">Rp {{ number_format($donatur->total_donasi, 0, ',', '.') }}</span>
                            <span class="payment-method">
                                <i class="fa-solid fa-circle payment-dot"></i>
                                Via {{ $donatur->tipe_bayar }}
                            </span>
                        </div>
                        @if($donatur->pesan)
                            <div class="donatur-message">
                                <i class="fas fa-quote-left"></i>
                                {{ $donatur->pesan }}
                            </div>
                        @else
                            <div class="donatur-message">
                                Semoga berkah selalu.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-hand-holding-heart"></i>
            <h4>Belum ada donatur</h4>
            <p>Belum ada donatur untuk kampanye ini.</p>
        </div>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi berurutan untuk kartu donatur
        const cards = document.querySelectorAll('.donatur-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endpush