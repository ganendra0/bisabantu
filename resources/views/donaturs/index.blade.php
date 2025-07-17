@extends('layouts.admin')
@section('title', 'Daftar Donatur')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Donatur</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                @if ($donaturs->isEmpty())
                    <p class="text-center">Belum ada donatur.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Pesan</th>
                                    <th class="text-center">Jumlah Donasi</th>
                                    <th class="text-center">Metode</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donaturs as $donatur)
                                    <tr>
                                        <td>{{ $donatur->nama }}</td>
                                        <td>{{ $donatur->pesan }}</td>
                                        <td>Rp. {{ number_format($donatur->total_donasi, 0, ',', '.') }}</td>
                                        <td>{{ $donatur->tipe_bayar }}</td>
                                        <td class="text-center">
                                        <a href="{{ route('donaturs.edit', $donatur->id) }}" class="btn btn-sm btn-primary">EDIT</a>

                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $donatur->id }}">HAPUS</button>

                                        {{-- MODAL + FORM --}}
                                        <div class="modal fade" id="deleteModal{{ $donatur->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalLabel{{ $donatur->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('donaturs.destroy', $donatur->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel{{ $donatur->id }}">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Yakin ingin menghapus donatur <strong>{{ $donatur->nama }}</strong>?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
    </div>
</div>
@endsection
