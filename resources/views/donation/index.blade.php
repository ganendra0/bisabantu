@extends('layouts.header')
@section('title', 'Daftar Donatur')
{{-- DASHBOARD ADMIN --}}

@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Kampanye</h1>
        <div class="row">
            <div class="col-12">

                @if(session('success'))
                <p style="color: green">{{ session('success') }}</p>
                @endif

                    <a href="{{ route('donations.create') }}" class="btn btn-success">Tambah Donasi</a>


                @if ($donations->isEmpty())
                    <p class="text-center">Belum ada kampanye.</p>
                @else
                    <div class="container-xxl">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Pesan</th>
                                    <th class="text-center">Target (Rp)</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as $donation)
                                    <tr>
                                        <td>{{ $donation->id }}</td>
                                        <td>{{ $donation->name }}</td>
                                        <td>{{ $donation->message }}</td>
                                        <td>Rp. {{ number_format($donation->target, 0, ',', '.') }}</td>
                                        <td>{{ $donation->created_at }}</td>

                                        <td class="text-center">
                                            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST">
                                                <a href="{{ route('donations.edit', $donation->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btnation btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $donation->id }}">HAPUS</button>

                                                {{-- Notif Modal --}}
                                                <div class="modal fade" id="deleteModal{{ $donation->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Konfirmasi Hapus Donatur</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus donatur ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.096), 0 6px 30px rgba(0, 0, 0, 0.096);
        }
    </style>
    </style>
@endsection
