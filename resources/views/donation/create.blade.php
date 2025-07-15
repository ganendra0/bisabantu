<!DOCTYPE html>
<html>
<head>
    <title>Form Donasi</title>
</head>
<body>
    <h1>Form Donasi</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama:</label><br>
    <input type="text" name="name"><br><br>

    <label>Pesan:</label><br>
    <textarea name="message"></textarea><br><br>

    <label>Target Donasi (Rp):</label><br>
    <input type="number" name="target"><br><br>

    <label>Upload Gambar:</label><br>
    <input type="file" name="gambar"><br><br>

    <button type="submit">Kirim Donasi</button>
</form>


</body>
</html>

