<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua kategori
     */
    public function index(): View
    {
        // Ambil semua kategori, urutkan berdasarkan nama
        // withCount('assets') menghitung jumlah asset di setiap kategori
        $categories = Category::withCount('assets')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat kategori baru
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan kategori baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        // Simpan ke database
        Category::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu kategori
     */
    public function show(Category $category): View
    {
        // Load assets yang dimiliki kategori ini
        $category->load('assets');

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit kategori
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan kategori ke database
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        // Validasi input (unique kecuali untuk kategori ini sendiri)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        // Update di database
        $category->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus kategori dari database
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Hapus kategori
        $category->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}

