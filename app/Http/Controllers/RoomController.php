<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua ruangan
     */
    public function index(): View
    {
        // Ambil semua ruangan, urutkan berdasarkan nama
        // withCount('assets') menghitung jumlah asset di setiap ruangan
        $rooms = Room::withCount('assets')->orderBy('name')->get();

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat ruangan baru
     */
    public function create(): View
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan ruangan baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name',
        ], [
            'name.required' => 'Nama ruangan wajib diisi.',
            'name.unique' => 'Ruangan dengan nama ini sudah ada.',
        ]);

        // Simpan ke database
        Room::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu ruangan
     */
    public function show(Room $room): View
    {
        // Load assets yang ada di ruangan ini beserta kategorinya
        $room->load('assets.category');

        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit ruangan
     */
    public function edit(Room $room): View
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan ruangan ke database
     */
    public function update(Request $request, Room $room): RedirectResponse
    {
        // Validasi input (unique kecuali untuk ruangan ini sendiri)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $room->id,
        ], [
            'name.required' => 'Nama ruangan wajib diisi.',
            'name.unique' => 'Ruangan dengan nama ini sudah ada.',
        ]);

        // Update di database
        $room->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus ruangan dari database
     */
    public function destroy(Room $room): RedirectResponse
    {
        // Hapus ruangan
        $room->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('rooms.index')
            ->with('success', 'Ruangan berhasil dihapus!');
    }
}

