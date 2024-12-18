<!DOCTYPE html>
<html>
<head>
    <title>Daftar Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Film</h1>
        
        <!-- Form Pencarian -->
        <form action="{{ route('movies.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari film berdasarkan nama..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('movies.create') }}" class="btn btn-success mb-3">Tambah Film Baru</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tahun Rilis</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movies as $movie)
                <tr>
                    <td>{{ $movie['id'] }}</td>
                    <td>{{ $movie['nama'] }}</td>
                    <td>{{ $movie['tahun_rilis'] }}</td>
                    <td>{{ $movie['deskripsi'] }}</td>
                    <td>
                        <a href="{{ route('movies.edit', $movie['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('movies.destroy', $movie['id']) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        @if(request('search'))
                            Tidak ada film yang ditemukan untuk pencarian "{{ request('search') }}"
                        @else
                            Tidak ada film tersedia
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>