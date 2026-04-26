<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Akademik extends BaseController
{
    // 1. Halaman utama (Method index() menampilkan judul 'Sistem Informasi Akademik' dan nama mahasiswa)
    public function index(): string
    {
        return "<h1>Sistem Informasi Akademik</h1>
                <p>Nama: Ahmad Arrizqianur Aslamudin</p>";
    }

    // 2. Daftar mata kuliah (Method matkul() menampilkan daftar 5 mata kuliah)
    public function matkul(): string
    {
        $matkul = [
            "Riset Operasi",
            "Jaringan Syaraf Tiruan",
            "Sistem Penunjang Keputusan",
            "Metodologi Penelitian",
            "Keamanan Sistem Komputer"
        ];

        $html = "<h1>Daftar Mata Kuliah</h1><ul>";
        foreach ($matkul as $m) {
            $html .= "<li>$m</li>";
        }
        $html .= "</ul>";

        return $html;
    }

    // 3. Method dengan parameter (Method nilai($nim) menerima parameter NIM dan menampilkan pesan 'Nilai mahasiswa dengan NIM: [nim]')
    public function nilai($nim): string
    {
        return "<h1>Nilai Mahasiswa</h1>
                <p>Nilai mahasiswa dengan NIM: $nim</p>";
    }
}
