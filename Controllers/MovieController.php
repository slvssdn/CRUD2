<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data movie dengan relasi genre
        $movies = Movie::with('genre')->get();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data genre untuk pilihan pada form create
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:1000',
            'poster' => 'nullable|string|max:255', // Validasi poster opsional
            'year' => 'required|integer|digits:4',
            'available' => 'required|boolean',
            'genre_id' => 'required|exists:genres,id', // Pastikan genre_id ada di tabel genres
        ]);

        // Menyimpan data movie yang telah divalidasi
        Movie::create([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'poster' => $validated['poster'] ?? null, // Jika poster tidak ada, tetap bisa null
            'year' => $validated['year'],
            'available' => $validated['available'],
            'genre_id' => $validated['genre_id'],  // Menyimpan genre_id
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie has been successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail movie beserta genre
        $movie = Movie::with('genre')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil movie yang akan diedit dan daftar genre
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:1000',
            'poster' => 'nullable|string|max:255', // Validasi poster opsional
            'year' => 'required|integer|digits:4',
            'available' => 'required|boolean',
            'genre_id' => 'required|exists:genres,id', // Validasi foreign key genre
        ]);

        // Mengambil movie sesuai ID yang dikirim dan melakukan update
        $movie = Movie::findOrFail($id);
        $movie->update([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'poster' => $validated['poster'] ?? null, // Menggunakan null jika tidak ada poster
            'year' => $validated['year'],
            'available' => $validated['available'],
            'genre_id' => $validated['genre_id'],  // Menyimpan genre_id
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus movie sesuai ID
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie has been successfully deleted!');
    }
}
