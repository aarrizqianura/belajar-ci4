<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class='bg-info text-white rounded-3 p-5 mb-4'>
    <h1 class='display-5 fw-bold'>
        <i class='bi bi-person-circle'></i> Profil Mahasiswa
    </h1>
    <p class='fs-5'>Informasi data akademik lengkap.</p>
</div>

<!-- Profil Card -->
<div class='row g-4 mb-5'>
    <!-- Data Pribadi -->
    <div class='col-lg-8'>
        <div class='card h-100 border-info shadow-sm'>
            <div class='card-header bg-info text-white'>
                <i class='bi bi-person'></i> Data Pribadi
            </div>
            <div class='card-body'>
                <div class='row mb-3'>
                    <div class='col-sm-4'>
                        <p class='text-muted mb-1'><i class='bi bi-hash'></i> NPM</p>
                        <h6><?= esc($npm) ?></h6>
                    </div>
                    <div class='col-sm-8'>
                        <p class='text-muted mb-1'><i class='bi bi-person-fill'></i> Nama Lengkap</p>
                        <h6><?= esc($nama) ?></h6>
                    </div>
                </div>
                <div class='row mb-3'>
                    <div class='col-sm-6'>
                        <p class='text-muted mb-1'><i class='bi bi-book'></i> Program Studi</p>
                        <h6><?= esc($prodi) ?></h6>
                    </div>
                    <div class='col-sm-6'>
                        <p class='text-muted mb-1'><i class='bi bi-calendar'></i> Angkatan</p>
                        <h6><?= esc($angkatan) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- IPK Card -->
    <div class='col-lg-4'>
        <div class='card h-100 shadow-sm'>
            <div class='card-body text-center'>
                <h5 class='card-title mb-3'><i class='bi bi-graph-up'></i> Indeks Prestasi</h5>
                <h2 class='mb-3'><?= esc($ipk) ?></h2>
                <?php
                if ($ipk >= 3.5) {
                    $badge_class = 'bg-success';
                    $label = 'Sangat Memuaskan';
                } elseif ($ipk >= 3.0) {
                    $badge_class = 'bg-warning';
                    $label = 'Memuaskan';
                } else {
                    $badge_class = 'bg-danger';
                    $label = 'Cukup';
                }
                ?>
                <span class='badge <?= $badge_class ?> fs-6'>
                    <?= esc($label) ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Mata Kuliah -->
<div class='card shadow-sm'>
    <div class='card-header bg-primary text-white'>
        <h5 class='mb-0'><i class='bi bi-journals'></i> Daftar Mata Kuliah yang Sedang Diambil</h5>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover mb-0'>
                <thead class='table-light'>
                    <tr>
                        <th><i class='bi bi-hash'></i> Kode</th>
                        <th><i class='bi bi-book'></i> Nama Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matkul as $index => $mk): ?>
                        <tr>
                            <td>
                                <span class='badge bg-secondary'><?= esc($mk['kode']) ?></span>
                            </td>
                            <td><?= esc($mk['nama']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class='card-footer bg-light text-muted'>
        <small><i class='bi bi-info-circle'></i> Total <?= count($matkul) ?> mata kuliah</small>
    </div>
</div>

<?= $this->endSection() ?>