<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua asset dengan filter
     */
    public function index(Request $request): View
    {
        // Query builder untuk asset
        $query = Asset::with(['category', 'room']);

        // Filter berdasarkan kategori (jika ada)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan ruangan (jika ada)
        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        // Filter berdasarkan kondisi (jika ada)
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Pencarian berdasarkan nama atau kode
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan pagination
        $assets = $query->orderBy('created_at', 'desc')->paginate(15);

        // Data untuk dropdown filter
        $categories = Category::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $conditions = ['bagus', 'rusak ringan', 'rusak sedang', 'rusak berat', 'hilang', 'diperbaiki'];

        return view('assets.index', compact('assets', 'categories', 'rooms', 'conditions'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat asset baru
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $conditions = ['bagus', 'rusak ringan', 'rusak sedang', 'rusak berat', 'hilang', 'diperbaiki'];

        return view('assets.create', compact('categories', 'rooms', 'conditions'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan asset baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'room_id' => 'required|exists:rooms,id',
            'code' => 'required|string|max:50|unique:assets,code',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'purchase_date' => 'required|date',
            'condition' => 'required|in:bagus,rusak ringan,rusak sedang,rusak berat,hilang,diperbaiki',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'room_id.required' => 'Ruangan wajib dipilih.',
            'room_id.exists' => 'Ruangan tidak valid.',
            'code.required' => 'Kode asset wajib diisi.',
            'code.unique' => 'Kode asset sudah digunakan.',
            'name.required' => 'Nama asset wajib diisi.',
            'purchase_date.required' => 'Tanggal pembelian wajib diisi.',
            'purchase_date.date' => 'Format tanggal tidak valid.',
            'condition.required' => 'Kondisi wajib dipilih.',
        ]);

        // Simpan ke database
        Asset::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('assets.index')
            ->with('success', 'Asset berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu asset
     */
    public function show(Asset $asset): View
    {
        // Load relasi yang dibutuhkan
        $asset->load(['category', 'room', 'damageReports.user', 'maintenanceLogs.user']);

        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit asset
     */
    public function edit(Asset $asset): View
    {
        $categories = Category::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $conditions = ['bagus', 'rusak ringan', 'rusak sedang', 'rusak berat', 'hilang', 'diperbaiki'];

        return view('assets.edit', compact('asset', 'categories', 'rooms', 'conditions'));
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan asset ke database
     */
    public function update(Request $request, Asset $asset): RedirectResponse
    {
        // Validasi input (unique kecuali untuk asset ini sendiri)
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'room_id' => 'required|exists:rooms,id',
            'code' => 'required|string|max:50|unique:assets,code,' . $asset->id,
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'purchase_date' => 'required|date',
            'condition' => 'required|in:bagus,rusak ringan,rusak sedang,rusak berat,hilang,diperbaiki',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'room_id.required' => 'Ruangan wajib dipilih.',
            'code.required' => 'Kode asset wajib diisi.',
            'code.unique' => 'Kode asset sudah digunakan.',
            'name.required' => 'Nama asset wajib diisi.',
            'purchase_date.required' => 'Tanggal pembelian wajib diisi.',
            'condition.required' => 'Kondisi wajib dipilih.',
        ]);

        // Update di database
        $asset->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('assets.index')
            ->with('success', 'Asset berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus asset dari database
     */
    public function destroy(Asset $asset): RedirectResponse
    {
        // Hapus asset
        $asset->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('assets.index')
            ->with('success', 'Asset berhasil dihapus!');
    }
}

