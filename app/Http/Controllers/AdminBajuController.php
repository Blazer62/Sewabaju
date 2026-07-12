<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use App\Models\Aksesoris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBajuController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'all');
        $search   = $request->get('search', '');

        $query = Baju::with('aksesoris');

        if ($kategori !== 'all') {
            $query->whereJsonContains('kategori', $kategori);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $bajus = $query->latest()->paginate(15);

        $stats = [
            'adat'  => Baju::whereJsonContains('kategori', 'adat')->count(),
            'tari'  => Baju::whereJsonContains('kategori', 'tari')->count(),
            'musik' => Baju::whereJsonContains('kategori', 'musik')->count(),
            'total' => Baju::count(),
        ];

        return view('admin.dashboard', compact('bajus', 'stats', 'kategori', 'search'));
    }

    public function store(Request $request)
    {
        // Filter aksesoris kosong sebelum validasi
        if ($request->has('aksesoris_nama')) {
            $namaList = $request->input('aksesoris_nama', []);
            $filteredNama = [];
            foreach ($namaList as $i => $nama) {
                if (trim($nama ?? '') !== '') {
                    $filteredNama[] = $nama;
                }
            }
            $request->merge([
                'aksesoris_nama' => $filteredNama,
            ]);
        }

        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string|max:500',
            'kategori'    => 'required|array',
            'kategori.*'  => 'required|in:adat,tari,musik',
            'ketersediaan'=> 'nullable|in:tersedia,disewa,tidak_tersedia',
            'aksesoris_nama.*'  => 'nullable|string|max:100',
        ], [
            'nama.required'       => 'Nama baju wajib diisi.',
            'kategori.required'   => 'Pilih minimal 1 kategori.',
            'kategori.*.in'       => 'Kategori tidak valid.',
        ]);

        // Handle upload file gambar
        if ($request->hasFile('gambar_file')) {
            $file = $request->file('gambar_file');
            $path = $file->store('bajus', 'public');
            $validated['gambar'] = $path;
        }

        $baju = Baju::create([
            'nama'        => $validated['nama'],
            'deskripsi'   => $validated['deskripsi'] ?? null,
            'gambar'      => $validated['gambar'] ?: null,
            'kategori'    => $validated['kategori'],
            'ketersediaan'=> $validated['ketersediaan'] ?? 'tersedia',
            'aktif'       => true,
        ]);

        // Simpan aksesoris
        if ($request->has('aksesoris_nama')) {
            foreach ($request->aksesoris_nama as $namaAcc) {
                if (trim($namaAcc) !== '') {
                    Aksesoris::create([
                        'baju_id' => $baju->id,
                        'nama'    => $namaAcc,
                    ]);
                }
            }
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "Baju \"{$baju->nama}\" berhasil ditambahkan!");
    }

    public function edit(Baju $baju)
    {
        $baju->load('aksesoris');
        return view('admin.edit', compact('baju'));
    }

    public function update(Request $request, Baju $baju)
    {
        // Filter aksesoris kosong sebelum validasi
        if ($request->has('aksesoris_nama')) {
            $namaList = $request->input('aksesoris_nama', []);
            $filteredNama = [];
            foreach ($namaList as $i => $nama) {
                if (trim($nama ?? '') !== '') {
                    $filteredNama[] = $nama;
                }
            }
            $request->merge([
                'aksesoris_nama' => $filteredNama,
            ]);
        }

        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string|max:500',
            'kategori'    => 'required|array',
            'kategori.*'  => 'required|in:adat,tari,musik',
            'ketersediaan'=> 'nullable|in:tersedia,disewa,tidak_tersedia',
            'aktif'       => 'nullable|boolean',
            'aksesoris_nama.*'  => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('gambar_file')) {
            if ($baju->gambar && !str_starts_with($baju->gambar, 'http')) {
                Storage::disk('public')->delete($baju->gambar);
            }
            $path = $request->file('gambar_file')->store('bajus', 'public');
            $validated['gambar'] = $path;
        }

        $baju->update([
            'nama'        => $validated['nama'],
            'deskripsi'   => $validated['deskripsi'] ?? null,
            'gambar'      => $validated['gambar'] ?: $baju->gambar,
            'kategori'    => $validated['kategori'],
            'ketersediaan'=> $validated['ketersediaan'] ?? 'tersedia',
            'aktif'       => $request->boolean('aktif', false),
        ]);

        // Update aksesoris: hapus lama, simpan baru
        $baju->aksesoris()->delete();
        if ($request->has('aksesoris_nama')) {
            foreach ($request->aksesoris_nama as $namaAcc) {
                if (trim($namaAcc) !== '') {
                    Aksesoris::create([
                        'baju_id' => $baju->id,
                        'nama'    => $namaAcc,
                    ]);
                }
            }
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "Baju \"{$baju->nama}\" berhasil diperbarui!");
    }

    public function destroy(Baju $baju)
    {
        $nama = $baju->nama;
        if ($baju->gambar && !str_starts_with($baju->gambar, 'http')) {
            Storage::disk('public')->delete($baju->gambar);
        }
        $baju->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', "Baju \"{$nama}\" berhasil dihapus.");
    }
}
