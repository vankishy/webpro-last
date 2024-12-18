<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    protected $apiUrl = 'http://localhost:3000/movies';

    public function index()
    {
        try {
            $response = Http::get($this->apiUrl);
            $movies = $response->json();
            return view('movies.index', compact('movies'));
        } catch (\Exception $e) {
            return redirect('https://http.cat/500');
            // return redirect()->back()->with('error', 'Gagal mengambil data film');
        }
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'tahun_rilis' => 'required|integer',
            'deskripsi' => 'required|string'
        ]);

        try {
            $response = Http::post($this->apiUrl, $validatedData);

            return redirect()->route('movies.index')
                ->with('success', 'Film berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('https://http.cat/500');
            // return redirect()->back()->with('error', 'Gagal menambahkan film');
        }
    }

    public function edit($id)
    {
        try {
            $response = Http::get($this->apiUrl . '/' . $id);
            $movie = $response->json();
            return view('movies.edit', compact('movie'));
        } catch (\Exception $e) {
            return redirect()->route('movies.index')
                ->with('error', 'Film tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'tahun_rilis' => 'required|integer',
            'deskripsi' => 'required|string'
        ]);

        try {
            $response = Http::put($this->apiUrl . '/' . $id, $validatedData);

            return redirect()->route('movies.index')
                ->with('success', 'Film berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate film');
        }
    }

    public function destroy($id)
    {
        try {
            Http::delete($this->apiUrl . '/' . $id);
            return redirect()->route('movies.index')
                ->with('success', 'Film berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus film');
        }
    }
}