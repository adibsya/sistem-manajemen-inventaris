<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DamageReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua laporan kerusakan
     */
    public function index(Request $request): View
    {
        $query = DamageReport::with(['asset', 'user']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama asset
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('asset', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $damageReports = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuses = ['pending', 'process', 'fixed', 'rejected'];

        return view('damage-reports.index', compact('damageReports', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat laporan kerusakan baru
     */
    public function create(): View
    {
        $assets = Asset::orderBy('name')->get();

        return view('damage-reports.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan laporan kerusakan baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'description' => 'required|string|min:10',
            'photo_evidence' => 'nullable|string|max:255',
        ], [
            'asset_id.required' => 'Asset wajib dipilih.',
            'asset_id.exists' => 'Asset tidak valid.',
            'description.required' => 'Deskripsi kerusakan wajib diisi.',
            'description.min' => 'Deskripsi minimal 10 karakter.',
        ]);

        // Tambahkan user_id dari user yang login
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        DamageReport::create($validated);

        return redirect()->route('damage-reports.index')
            ->with('success', 'Laporan kerusakan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu laporan kerusakan
     */
    public function show(DamageReport $damageReport): View
    {
        $damageReport->load(['asset.category', 'asset.room', 'user']);

        return view('damage-reports.show', compact('damageReport'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit laporan kerusakan (untuk update status)
     */
    public function edit(DamageReport $damageReport): View
    {
        $assets = Asset::orderBy('name')->get();
        $statuses = ['pending', 'process', 'fixed', 'rejected'];

        return view('damage-reports.edit', compact('damageReport', 'assets', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan laporan kerusakan ke database
     */
    public function update(Request $request, DamageReport $damageReport): RedirectResponse
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'description' => 'required|string|min:10',
            'photo_evidence' => 'nullable|string|max:255',
            'status' => 'required|in:pending,process,fixed,rejected',
        ], [
            'asset_id.required' => 'Asset wajib dipilih.',
            'description.required' => 'Deskripsi kerusakan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $damageReport->update($validated);

        // Jika status = fixed, update kondisi asset
        if ($validated['status'] === 'fixed') {
            $damageReport->asset->update(['condition' => 'bagus']);
        } elseif ($validated['status'] === 'process') {
            $damageReport->asset->update(['condition' => 'diperbaiki']);
        }

        return redirect()->route('damage-reports.index')
            ->with('success', 'Laporan kerusakan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus laporan kerusakan dari database
     */
    public function destroy(DamageReport $damageReport): RedirectResponse
    {
        $damageReport->delete();

        return redirect()->route('damage-reports.index')
            ->with('success', 'Laporan kerusakan berhasil dihapus!');
    }
}

