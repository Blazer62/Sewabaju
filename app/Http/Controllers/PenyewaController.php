<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index()
    {
        $kategoriList = ['adat', 'tari', 'musik'];
        $data = [];

        foreach ($kategoriList as $kat) {
            $data[$kat] = Baju::with('aksesoris')
                ->aktif()
                ->whereJsonContains('kategori', $kat)
                ->get()
                ->map(function ($baju) {
                    return [
                        'id'          => $baju->id,
                        'nama'        => $baju->nama,
                        'deskripsi'   => $baju->deskripsi,
                        'gambar'      => $baju->gambar_url,
                        'ketersediaan'=> $baju->ketersediaan,
                        'aksesoris'   => $baju->aksesoris->map(fn($a) => [
                            'nama'  => $a->nama,
                        ])->toArray(),
                    ];
                })->toArray();
        }

        return response()->view('penyewa.index', compact('data'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
