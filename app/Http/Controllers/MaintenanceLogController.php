<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceLog;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MaintenanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua riwayat perbaikan
     */
    public function index(Request $request): View
    {
        $query = MaintenanceLog::with(['asset', 'user']);

        // Pencarian berdasarkan nama asset
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('asset', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan bulan
        if ($request->filled('month')) {
            $query->whereMonth('completion_date', $request->month);
        }

        // Filter berdasarkan tahun
        if ($request->filled('year')) {
            $query->whereYear('completion_date', $request->year);
        }

        $maintenanceLogs = $query->orderBy('completion_date', 'desc')->paginate(15);

        // Hitung total biaya
        $totalCost = MaintenanceLog::sum('cost');

        return view('maintenance-logs.index', compact('maintenanceLogs', 'totalCost'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat riwayat perbaikan baru
     */
    public function create(): View
    {
        $assets = Asset::orderBy('name')->get();

        return view('maintenance-logs.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan riwayat perbaikan baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'action_taken' => 'required|string|min:10',
            'cost' => 'required|integer|min:0',
            'completion_date' => 'required|date',
        ], [
            'asset_id.required' => 'Asset wajib dipilih.',
            'asset_id.exists' => 'Asset tidak valid.',
            'action_taken.required' => 'Tindakan yang dilakukan wajib diisi.',
            'action_taken.min' => 'Tindakan minimal 10 karakter.',
            'cost.required' => 'Biaya wajib diisi.',
            'cost.integer' => 'Biaya harus berupa angka.',
            'cost.min' => 'Biaya tidak boleh negatif.',
            'completion_date.required' => 'Tanggal selesai wajib diisi.',
        ]);

        // Tambahkan user_id dari user yang login (teknisi)
        $validated['user_id'] = Auth::id();

        MaintenanceLog::create($validated);

        // Update kondisi asset menjadi bagus setelah diperbaiki
        $asset = Asset::find($validated['asset_id']);
        $asset->update(['condition' => 'bagus']);

        return redirect()->route('maintenance-logs.index')
            ->with('success', 'Riwayat perbaikan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu riwayat perbaikan
     */
    public function show(MaintenanceLog $maintenanceLog): View
    {
        $maintenanceLog->load(['asset.category', 'asset.room', 'user']);

        return view('maintenance-logs.show', compact('maintenanceLog'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit riwayat perbaikan
     */
    public function edit(MaintenanceLog $maintenanceLog): View
    {
        $assets = Asset::orderBy('name')->get();

        return view('maintenance-logs.edit', compact('maintenanceLog', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan riwayat perbaikan ke database
     */
    public function update(Request $request, MaintenanceLog $maintenanceLog): RedirectResponse
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'action_taken' => 'required|string|min:10',
            'cost' => 'required|integer|min:0',
            'completion_date' => 'required|date',
        ], [
            'asset_id.required' => 'Asset wajib dipilih.',
            'action_taken.required' => 'Tindakan yang dilakukan wajib diisi.',
            'cost.required' => 'Biaya wajib diisi.',
            'completion_date.required' => 'Tanggal selesai wajib diisi.',
        ]);

        $maintenanceLog->update($validated);

        return redirect()->route('maintenance-logs.index')
            ->with('success', 'Riwayat perbaikan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus riwayat perbaikan dari database
     */
    public function destroy(MaintenanceLog $maintenanceLog): RedirectResponse
    {
        $maintenanceLog->delete();

        return redirect()->route('maintenance-logs.index')
            ->with('success', 'Riwayat perbaikan berhasil dihapus!');
    }
}

