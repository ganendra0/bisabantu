@extends('layouts.admin')
@section('title', 'Detail Donation')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Donation</h4>
            </div>
            <div class="card-body">
                @if($donation->gambar)
                    <div class="text-center mb-4">
                        <img src="{{ asset('uploads/'.$donation->gambar) }}" alt="{{ $donation->name }}" class="img-fluid" style="max-height: 300px;">
                    </div>
                @endif
                
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama Kampanye:</th>
                        <td>{{ $donation->name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi:</th>
                        <td>{{ $donation->message ?: 'Tidak ada deskripsi' }}</td>
                    </tr>
                    <tr>
                        <th>Target Donasi:</th>
                        <td>Rp {{ number_format($donation->target, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Terkumpul:</th>
                        <td>Rp {{ number_format($donation->total_terkumpul, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Progress:</th>
                        <td>
                            @php
                                $progress = $donation->target > 0 ? ($donation->total_terkumpul / $donation->target) * 100 : 0;
                                $progress = min($progress, 100);
                            @endphp
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar" style="width: {{ $progress }}%">{{ number_format($progress, 1) }}%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Donatur:</th>
                        <td>{{ $donation->donaturs->count() }} orang</td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat:</th>
                        <td>{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate:</th>
                        <td>{{ $donation->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('donations.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('donations.edit', $donation) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection