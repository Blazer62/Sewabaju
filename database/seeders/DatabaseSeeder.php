<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Baju;
use App\Models\Aksesoris;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Admin default
        Admin::create([
            'name'     => 'Admin Nuansa',
            'email'    => 'admin@nuansa.id',
            'password' => Hash::make('nuansa2024'),
        ]);

        function placehold($name) {
            return 'https://placehold.co/400x250/f7ebda/8b5a2b?text=' . urlencode($name);
        }

        $data = [
            'adat' => [
                [
                    'nama'       => 'Adat Bali (Pria)',
                    'deskripsi'  => 'Kamen + Udeng + Saput khas Bali. Busana lengkap untuk upacara adat Bali.',
                    'gambar'     => placehold('Adat Bali'),
                    'aksesoris'  => [
                        ['nama' => 'Kamen'],
                        ['nama' => 'Udeng'],
                        ['nama' => 'Saput'],
                    ],
                ],
                [
                    'nama'       => 'Adat Papua',
                    'deskripsi'  => 'Koteka + Rok Rumbai khas Papua. Busana eksotis dari timur Indonesia.',
                    'gambar'     => placehold('Adat Papua'),
                    'aksesoris'  => [
                        ['nama' => 'Mahkota Bulu'],
                        ['nama' => 'Kalung'],
                    ],
                ],
                [
                    'nama'       => 'Adat Minang',
                    'deskripsi'  => 'Baju penghulu lengkap dengan tingkok. Busana khas Sumatera Barat.',
                    'gambar'     => placehold('Adat Minang'),
                    'aksesoris'  => [
                        ['nama' => 'Tingkok'],
                        ['nama' => 'Salempang'],
                    ],
                ],
                [
                    'nama'       => 'Adat Dayak',
                    'deskripsi'  => 'Rompi + Mahkota bulu khas Dayak. Busana dari Pedalaman Kalimantan.',
                    'gambar'     => placehold('Adat Dayak'),
                    'aksesoris'  => [
                        ['nama' => 'Mahkota'],
                        ['nama' => 'Gelang'],
                    ],
                ],
            ],
            'tari' => [
                [
                    'nama'       => 'Tari Japin Sigam',
                    'deskripsi'  => 'Tarian lincah khas Banjar, penuh dinamika dan pesona. Kostum lengkap dengan aksesoris.',
                    'gambar'     => placehold('Tari Japin Sigam'),
                    'aksesoris'  => [
                        ['nama' => 'Mahkota Japin'],
                        ['nama' => 'Rangkaian Bunga'],
                        ['nama' => 'Gelang Manik'],
                    ],
                ],
                [
                    'nama'       => 'Tari Pendet',
                    'deskripsi'  => 'Tari persembahan khas Bali. Kostum cantik dengan properti bokor.',
                    'gambar'     => placehold('Tari Pendet'),
                    'aksesoris'  => [
                        ['nama' => 'Bokor'],
                        ['nama' => 'Selendang'],
                    ],
                ],
                [
                    'nama'       => 'Tari Saman',
                    'deskripsi'  => 'Tari tepuk tangan khas Aceh. Dinamis dan penuh kekompakan.',
                    'gambar'     => placehold('Tari Saman'),
                    'aksesoris'  => [
                        ['nama' => 'Kain'],
                        ['nama' => 'Ikat Kepala'],
                    ],
                ],
                [
                    'nama'       => 'Tari Kipas',
                    'deskripsi'  => 'Tari kipas khas Makassar. Anggun dengan properti kipas.',
                    'gambar'     => placehold('Tari Kipas'),
                    'aksesoris'  => [
                        ['nama' => 'Kipas'],
                        ['nama' => 'Selendang'],
                    ],
                ],
            ],
            'musik' => [
                [
                    'nama'       => 'Kostum Panting',
                    'deskripsi'  => 'Busana pemusik Panting khas Banjar. Elegan dan nyaman untuk tampil.',
                    'gambar'     => placehold('Kostum Panting'),
                    'aksesoris'  => [
                        ['nama' => 'Kopiah'],
                        ['nama' => 'Sarung'],
                    ],
                ],
                [
                    'nama'       => 'Kostum Gamelan',
                    'deskripsi'  => 'Busana pemain gamelan Jawa. Profesional untuk pentas seni.',
                    'gambar'     => placehold('Kostum Gamelan'),
                    'aksesoris'  => [
                        ['nama' => 'Blangkon'],
                        ['nama' => 'Jarik'],
                    ],
                ],
                [
                    'nama'       => 'Kostum Angklung',
                    'deskripsi'  => 'Busana pemain angklung Sunda. Modern namun tetap tradisional.',
                    'gambar'     => placehold('Kostum Angklung'),
                    'aksesoris'  => [
                        ['nama' => 'Batik'],
                        ['nama' => 'Ikat Pinggang'],
                    ],
                ],
                [
                    'nama'       => 'Kostum Tifa',
                    'deskripsi'  => 'Busana pemain tifa Papua. Eksotis dan penuh warna.',
                    'gambar'     => placehold('Kostum Tifa'),
                    'aksesoris'  => [
                        ['nama' => 'Mahkota'],
                        ['nama' => 'Kalung'],
                    ],
                ],
            ],
        ];

        foreach ($data as $kategori => $bajuList) {
            foreach ($bajuList as $item) {
                $aksesorisData = $item['aksesoris'];
                unset($item['aksesoris']);
                $item['kategori'] = [$kategori];
                $baju = Baju::create($item);
                foreach ($aksesorisData as $acc) {
                    Aksesoris::create([
                        'baju_id' => $baju->id,
                        'nama'    => $acc['nama'],
                    ]);
                }
            }
        }
    }
}
