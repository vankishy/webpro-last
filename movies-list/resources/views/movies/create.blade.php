<!DOCTYPE html>
<html>
<head>
    <title>Tambah Film Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Film Baru</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('movies.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Film</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun Rilis</label>
                <input type="number" name="tahun_rilis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Film</button>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>