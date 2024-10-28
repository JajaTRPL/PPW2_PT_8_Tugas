<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h4>Tambah Buku</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menampilkan Flash Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="post" action="{{ route('buku.store') }}" id="bukuForm">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" name="penulis" id="penulis" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" required min="10000" max="50000">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" name="tgl_terbit" id="tgl_terbit" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        document.getElementById('bukuForm').onsubmit = function(e) {
            const judul = document.getElementById('judul').value;
            const penulis = document.getElementById('penulis').value;
            const harga = document.getElementById('harga').value;
            const tglTerbit = document.getElementById('tgl_terbit').value;

            if (!judul) {
                alert('Judul tidak boleh kosong!');
                e.preventDefault();
            } else if (!penulis) {
                alert('Penulis tidak boleh kosong!');
                e.preventDefault();
            } else if (harga === '' || harga < 10000 || harga > 50000) {
                alert('Harga harus di antara 10.000 dan 50.000!');
                e.preventDefault();
            } else if (!tglTerbit) {
                alert('Tanggal terbit tidak boleh kosong!');
                e.preventDefault();
            }
        }
    </script>

    <!-- Tambahkan link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
