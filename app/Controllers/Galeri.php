<?php

namespace App\Controllers;

class Galeri extends BaseController
{
    /**
     * Halaman galeri perpustakaan dengan filter kategori
     */
    public function index(): string
    {
        // Data galeri perpustakaan dengan minimal 6 item
        $galeri_data = [
            [
                'judul'       => 'Koleksi Buku Fiksi Terbaik',
                'url_gambar'  => 'https://picsum.photos/400/300?random=1',
                'deskripsi'   => 'Rak penyimpanan buku fiksi terlengkap di perpustakaan dengan koleksi novel, cerpen, dan karya sastra modern dari penulis lokal maupun internasional yang akan membawa pembaca ke dunia imajinasi yang menakjubkan.',
                'kategori'    => 'fiksi'
            ],
            [
                'judul'       => 'Referensi Ensiklopedia Lengkap',
                'url_gambar'  => 'https://picsum.photos/400/300?random=2',
                'deskripsi'   => 'Koleksi ensiklopedia dan buku referensi untuk penelitian akademis dan pengetahuan umum. Pustaka referensi yang komprehensif mencakup berbagai topik dari sejarah, geografi, sains, hingga teknologi modern.',
                'kategori'    => 'referensi'
            ],
            [
                'judul'       => 'Buku Non-Fiksi Populer',
                'url_gambar'  => 'https://picsum.photos/400/300?random=3',
                'deskripsi'   => 'Koleksi buku non-fiksi yang informatif dan menarik tentang pengembangan diri, bisnis, seni, dan pengetahuan praktis. Buku-buku yang memberikan insight berharga dan wawasan mendalam tentang kehidupan nyata dan topik kontemporer.',
                'kategori'    => 'non-fiksi'
            ],
            [
                'judul'       => 'Ruang Baca Nyaman Perpustakaan',
                'url_gambar'  => 'https://picsum.photos/400/300?random=4',
                'deskripsi'   => 'Area baca yang dirancang ergonomis dengan pencahayaan optimal dan furnitur nyaman. Ruang yang tenang dan kondusif untuk membaca, belajar, dan melakukan penelitian dengan semua fasilitas pendukung yang lengkap.',
                'kategori'    => 'fasilitas'
            ],
            [
                'judul'       => 'Koleksi Jurnal Ilmiah Terkini',
                'url_gambar'  => 'https://picsum.photos/400/300?random=5',
                'deskripsi'   => 'Perpustakaan jurnal penelitian dan publikasi ilmiah terbaru dari berbagai universitas dan institusi penelitian. Sumber daya akademik yang penting untuk mahasiswa dan peneliti dalam mengakses informasi ilmu pengetahuan terdepan.',
                'kategori'    => 'referensi'
            ],
            [
                'judul'       => 'Buku Anak-Anak Edukatif',
                'url_gambar'  => 'https://picsum.photos/400/300?random=6',
                'deskripsi'   => 'Koleksi buku cerita dan buku pelajaran untuk anak-anak dengan ilustrasi menarik dan konten edukatif. Perpustakaan anak yang dirancang untuk menginspirasi minat baca sejak dini dan mengembangkan imajinasi kreatif anak-anak.',
                'kategori'    => 'fiksi'
            ],
            [
                'judul'       => 'Literatur Klasik Abadi',
                'url_gambar'  => 'https://picsum.photos/400/300?random=7',
                'deskripsi'   => 'Koleksi karya-karya sastra klasik dunia yang telah melampaui ujian waktu. Edisi lengkap dari penulis terkenal seperti Shakespeare, Jane Austen, dan tokoh-tokoh literatur besar lainnya yang masih relevan hingga saat ini.',
                'kategori'    => 'fiksi'
            ],
            [
                'judul'       => 'Koleksi Digital dan E-Book',
                'url_gambar'  => 'https://picsum.photos/400/300?random=8',
                'deskripsi'   => 'Akses perpustakaan digital dengan ribuan e-book dan sumber pembelajaran online. Teknologi perpustakaan modern yang memungkinkan pengguna mengakses koleksi buku dari mana saja kapan saja melalui berbagai perangkat digital.',
                'kategori'    => 'non-fiksi'
            ]
        ];

        // Get kategori dari query parameter
        $kategori_aktif = $this->request->getGet('kategori') ?? 'semua';

        // Filter galeri berdasarkan kategori
        if ($kategori_aktif !== 'semua' && $kategori_aktif !== '') {
            $galeri_items = array_filter($galeri_data, function ($item) use ($kategori_aktif) {
                return $item['kategori'] === $kategori_aktif;
            });
        } else {
            $galeri_items = $galeri_data;
            $kategori_aktif = 'semua';
        }

        // Ambil daftar kategori unik
        $semua_kategori = array_unique(array_column($galeri_data, 'kategori'));
        sort($semua_kategori);

        $data = [
            'title'             => 'Galeri Perpustakaan',
            'galeri_items'      => $galeri_items,
            'kategori_aktif'    => $kategori_aktif,
            'semua_kategori'    => $semua_kategori,
            'breadcrumb'        => [
                ['label' => 'Galeri Perpustakaan', 'url' => base_url('galeri')]
            ]
        ];

        return view('galeri/index', $data);
    }
}
