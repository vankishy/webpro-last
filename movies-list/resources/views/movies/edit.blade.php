<!DOCTYPE html>
<html>
<head>
    <title>Edit Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Film</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('movies.update', $movie['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Film</label>
                <input type="text" name="nama" class="form-control" value="{{ $movie['nama'] }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun Rilis</label>
                <input type="number" name="tahun_rilis" class="form-control" value="{{ $movie['tahun_rilis'] }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required>{{ $movie['deskripsi'] }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Film</button>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>