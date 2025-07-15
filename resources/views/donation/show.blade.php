<!DOCTYPE html>
<html>
<head>
    <title>Detail Donasi</title>
    <style>
        .card { border: 1px solid #ddd; padding: 20px; margin: 20px 0; border-radius: 5px; }
        .btn { padding: 10px 15px; margin: 5px; text-decoration: none; border-radius: 3px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-secondary { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <h1>Detail Donasi</h1>

    <div class="card">
        <h3>{{ $donation->name }}</h3>
        <p><strong>Pesan:</strong> {{ $donation->message ?: 'Tidak ada pesan' }}</p>
        <p><strong>Target Donasi:</strong> Rp {{ number_format($donation->target, 0, ',', '.') }}</p>
        <p><strong>Tanggal Dibuat:</strong> {{ $donation->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Terakhir Diupdate:</strong> {{ $donation->updated_at->format('d/m/Y H:i') }}</p>
    </div>

    <a href="{{ route('donations.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('donations.edit', $donation) }}" class="btn btn-warning">Edit</a>
</body>
</html>