<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="{{ route('buku.search') }}" method="get">
            <input type="text" name="kata" class="form-control" placeholder="Cari..." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
        </form>

        <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(isset($cari))
            @if(count($data_buku))
                <div class="alert alert-success">Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan kata: <strong>{{ $cari }}</strong></div>
            @else
                <div class="alert alert-warning"><h4>Data <strong>{{ $cari }}</strong> tidak ditemukan</h4><a href="/buku" class="btn btn-warning">Kembali</a></div>
            @endif
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>                        
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data_buku))
                    @foreach($data_buku as $buku)
                    <tr>                        
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data buku.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Menampilkan jumlah total buku -->
        <p><strong>Jumlah Total Buku:</strong> {{ $jumlah_buku }}</p>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
