<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class='bg-primary text-white rounded-3 p-5 mb-4'>
    <h1 class='display-5 fw-bold'>
        <i class='bi bi-book-half'></i> Galeri Perpustakaan
    </h1>
    <p class='fs-5'>Koleksi buku dan fasilitas dari berbagai kategori perpustakaan</p>
</div>

<!-- Category Filter -->
<div class='mb-4'>
    <h5 class='mb-3'>Filter Kategori:</h5>
    <div class='btn-group flex-wrap' role='group'>
        <!-- Tombol Semua -->
        <a href='<?= base_url('galeri') ?>'
            class='btn btn-outline-primary <?= ($kategori_aktif === 'semua') ? 'active' : '' ?>'>
            <i class='bi bi-list'></i> Semua
        </a>

        <!-- Tombol untuk setiap kategori -->
        <?php foreach ($semua_kategori as $kategori): ?>
            <a href='<?= base_url('galeri?kategori=' . urlencode($kategori)) ?>'
                class='btn btn-outline-primary <?= ($kategori_aktif === $kategori) ? 'active' : '' ?>'>
                <i class='bi bi-tag'></i> <?= ucfirst($kategori) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Gallery Grid -->
<div class='row g-4'>
    <?php if (empty($galeri_items)): ?>
        <div class='col-12'>
            <div class='alert alert-info' role='alert'>
                <i class='bi bi-info-circle'></i> Tidak ada gambar dalam kategori ini.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($galeri_items as $item): ?>
            <div class='col-md-4 col-sm-6'>
                <div class='card h-100 shadow-sm hover-shadow-lg transition'>
                    <!-- Image -->
                    <img src='<?= esc($item['url_gambar']) ?>'
                        class='card-img-top'
                        alt='<?= esc($item['judul']) ?>'
                        style='height: 250px; object-fit: cover;'>

                    <!-- Card Body -->
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title'><?= esc($item['judul']) ?></h5>

                        <p class='card-text text-muted flex-grow-1'>
                            <?= truncate_text($item['deskripsi'], 100) ?>
                        </p>

                        <!-- Category Badge -->
                        <div class='mt-2'>
                            <?= status_badge($item['kategori']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Custom CSS for hover effect -->
<style>
    .hover-shadow-lg {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
</style>

<?= $this->endSection() ?>