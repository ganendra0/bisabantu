<!DOCTYPE html>
<html>
<head>
    <title>Edit Donasi</title>
    <style>
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        .btn { padding: 10px 15px; margin: 5px; text-decoration: none; border-radius: 3px; border: none; cursor: pointer; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Edit Donasi</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('donations.update', $donation) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="name" value="{{ old('name', $donation->name) }}" required>
    </div>

    <div class="form-group">
        <label>Pesan:</label>
        <textarea name="message" rows="4">{{ old('message', $donation->message) }}</textarea>
    </div>

    <div class="form-group">
        <label>Target Donasi (Rp):</label>
        <input type="number" name="target" value="{{ old('target', $donation->target) }}" required min="1">
    </div>

    <div class="form-group">
  <label>Gambar:</label>
  <input type="file" name="gambar">
  @if($donation->gambar)
    <br><img src="{{ asset('uploads/'.$donation->gambar) }}" width="120" style="margin-top:10px;">
  @endif
</div>


    <button type="submit" class="btn btn-primary">Update Donasi</button>
    <a href="{{ route('donations.index') }}" class="btn btn-secondary">Batal</a>
</form>

</body>
</html>