const express = require('express');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 3000;

const MOVIES_FILE = path.join(__dirname, 'movies.json');

function readMovies() {
    try {
        const data = fs.readFileSync(MOVIES_FILE, 'utf8');
        return JSON.parse(data);
    } catch (error) {
        return [];
    }
}

function writeMovies(movies) {
    fs.writeFileSync(MOVIES_FILE, JSON.stringify(movies, null, 2));
}

app.use(express.json());

app.get('/movies', (req, res) => {
    const movies = readMovies();
    res.json(movies);
});

app.get('/movies/:nama', (req, res) => {
    const movies = readMovies();
    const movie = movies.find(m => m.nama === parseInt(req.params.nama));

    if (!movie) {
        return res.status(404).json({ message: "Movie tidak ditemukan" });
    }

    res.json(movie);
});

app.post('/movies', (req, res) => {
    const { nama, tahun_rilis, deskripsi } = req.body;

    if (!nama || !tahun_rilis || !deskripsi) {
        return res.status(400).json({
            message: "Semua field (nama, tahun_rilis, deskripsi) harus diisi"
        });
    }

    const movies = readMovies();
    const newMovie = {
        id: movies.length > 0 ? Math.max(...movies.map(m => m.id)) + 1 : 1,
        nama,
        tahun_rilis,
        deskripsi
    };

    movies.push(newMovie);
    writeMovies(movies);
    res.status(201).json(newMovie);
});

app.put('/movies/:id', (req, res) => {
    const { nama, tahun_rilis, deskripsi } = req.body;

    if (!nama || !tahun_rilis || !deskripsi) {
        return res.status(400).json({
            message: "Semua field (nama, tahun_rilis, deskripsi) harus diisi"
        });
    }

    const movies = readMovies();
    const movieIndex = movies.findIndex(m => m.id === parseInt(req.params.id));

    if (movieIndex === -1) {
        return res.status(404).json({ message: "Movie tidak ditemukan" });
    }

    movies[movieIndex] = {
        ...movies[movieIndex],
        nama,
        tahun_rilis,
        deskripsi
    };

    writeMovies(movies);
    res.json(movies[movieIndex]);
});

app.delete('/movies/:id', (req, res) => {
    const movies = readMovies();
    const movieIndex = movies.findIndex(m => m.id === parseInt(req.params.id));

    if (movieIndex === -1) {
        return res.status(404).json({ message: "Movie tidak ditemukan" });
    }

    movies.splice(movieIndex, 1);
    writeMovies(movies);
    res.status(204).send();
});

app.listen(PORT, () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
});