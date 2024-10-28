<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    <div>
        <h4>Edit Buku</h4>

        <!-- Menampilkan error validasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form method="post" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            @method('PUT') <!-- Menambahkan metode PUT untuk update data -->
            <!-- Input Judul -->
            <div>Judul
                <input type="text" name="judul" value="{{ $buku->judul }}">
            </div>
            <!-- Input Penulis -->
            <div>Penulis
                <input type="text" name="penulis" value="{{ $buku->penulis }}">
            </div>
            <!-- Input Harga -->
            <div>Harga
                <input type="number" name="harga" value="{{ $buku->harga }}">
            </div>
            <!-- Input Tanggal Terbit -->
            <div>Tanggal Terbit
                <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit->format('Y-m-d') }}">
            </div>
            <button type="submit">Update</button>
            <a href="{{ route('buku.index') }}">Kembali</a> <!-- Sebaiknya menggunakan route jika ada -->
        </form>
    </div>
</body>
</html>
