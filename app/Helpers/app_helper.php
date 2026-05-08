<?php

/** 
 * Helper kustom untuk aplikasi praktikum 
 * Fungsi helper tersedia secara global setelah helper dimuat. 
 */

if (!function_exists('format_tanggal')) {
    /** 
     * Format tanggal dari format database ke format Indonesia 
     * @param string $tanggal Format: Y-m-d atau Y-m-d H:i:s 
     * @return string Format: d F Y (contoh: 25 Januari 2024) 
     */
    function format_tanggal(string $tanggal): string
    {
        $bulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $timestamp = strtotime($tanggal);
        return date('d', $timestamp) . ' '
            . $bulan[(int) date('m', $timestamp)] . ' '
            . date('Y', $timestamp);
    }
}

if (!function_exists('format_rupiah')) {
    /** 
     * Format angka menjadi format Rupiah 
     * @param int|float $nominal 
     * @return string Contoh: Rp 1.500.000 
     */
    function format_rupiah($nominal): string
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
}

if (!function_exists('truncate_text')) {
    /** 
     * Potong teks jika melebihi panjang tertentu 
     * @param string $text Teks yang akan dipotong 
     * @param int $length Panjang maksimum 
     * @return string 
     */
    function truncate_text(string $text, int $length = 100): string
    {
        if (strlen($text) <= $length) return $text;
        return substr($text, 0, $length) . '...';
    }
}

if (!function_exists('status_badge')) {
    /** 
     * Menghasilkan HTML badge Bootstrap berdasarkan status 
     * @param string $status 
     * @return string HTML badge 
     */
    function status_badge(string $status): string
    {
        $map = [
            'aktif'       => 'success',
            'nonaktif'    => 'secondary',
            'dipinjam'    => 'warning',
            'tersedia'    => 'info',
            'hilang'      => 'danger',
        ];
        $warna = $map[strtolower($status)] ?? 'secondary';
        return "<span class='badge bg-{$warna}'>" . ucfirst($status) . "</span>";
    }
}

if (!function_exists('inisial_nama')) {
    /** 
     * Mengambil inisial dari nama lengkap 
     * @param string $namaLengkap Contoh: 'Ahmad Arrizqianur Aslamudin' 
     * @return string Inisial nama (contoh: 'AAA') 
     */
    function inisial_nama(string $namaLengkap): string
    {
        $nama_array = explode(' ', trim($namaLengkap));
        $inisial = '';

        foreach ($nama_array as $nama) {
            if (!empty($nama)) {
                $inisial .= strtoupper($nama[0]);
            }
        }

        return $inisial;
    }
}

if (!function_exists('avatar_url')) {
    /** 
     * Menghasilkan URL avatar dari ui-avatars.com 
     * @param string $nama Nama untuk ditampilkan di avatar 
     * @param int $size Ukuran avatar dalam pixel (default: 128) 
     * @return string URL avatar 
     */
    function avatar_url(string $nama, int $size = 128): string
    {
        $encoded_nama = urlencode($nama);
        return "https://ui-avatars.com/api/?name={$encoded_nama}&size={$size}&background=random";
    }
}
