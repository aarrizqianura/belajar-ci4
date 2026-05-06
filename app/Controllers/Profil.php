<?php

namespace App\Controllers;

class Profil extends BaseController
{
    /**
     * Halaman profil dengan data akademik lengkap
     */
    public function index(): string
    {
        $data = [
            'title'     => 'Profil Mahasiswa',
            'npm'       => '2310010433',
            'nama'      => 'Ahmad Arrizqianur Aslamudin',
            'prodi'     => 'Teknik Informatika',
            'angkatan'  => 2023,
            'ipk'       => 3.77,
            'matkul'    => [
                ['kode' => 'TIF201', 'nama' => 'Jaringan Syaraf Tiruan'],
                ['kode' => 'TIF202', 'nama' => 'Riset Operasi'],
                ['kode' => 'TIF203', 'nama' => 'Metode Penelitian'],
                ['kode' => 'TIF204', 'nama' => 'Sistem Penunjang Keputusan'],
                ['kode' => 'TIF205', 'nama' => 'Keamanan Sistem Komputer'],
            ],
            'breadcrumb' => [
                ['label' => 'Profil', 'url' => base_url('profil')],
            ],
        ];

        return view('profil/index', $data);
    }
}
