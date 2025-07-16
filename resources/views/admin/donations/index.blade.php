@extends('layouts.admin')
@section('title', 'Donations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Donations</h1>
    <a href="{{ route('donations.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Donation
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Target</th>
                        <th>Terkumpul</th>
                        <th>Progress</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>{{ $donation->name }}</td>
                        <td>Rp {{ number_format($donation->target, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($donation->total_terkumpul, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $progress = $donation->target > 0 ? ($donation->total_terkumpul / $donation->target) * 100 : 0;
                                $progress = min($progress, 100);
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" style="width: {{ $progress }}%">{{ number_format($progress, 1) }}%</div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('donations.show', $donation) }}" class="btn btn-sm btn-info">Lihat</a>
                            <a href="{{ route('donations.edit', $donation) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('donations.destroy', $donation) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection