@extends('layouts.admin')
@section('title', 'Edit Donation')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Donation</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('donations.update', $donation) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Kampanye</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $donation->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="message" class="form-control" rows="4">{{ old('message', $donation->message) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Target Donasi (Rp)</label>
                        <input type="number" name="target" class="form-control" value="{{ old('target', $donation->target) }}" required min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        @if($donation->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/'.$donation->gambar) }}" alt="Current" width="100" class="img-thumbnail">
                                <small class="text-muted d-block">Gambar saat ini</small>
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('donations.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection