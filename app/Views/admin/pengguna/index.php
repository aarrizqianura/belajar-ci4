<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-people"></i> Manajemen Pengguna</h2>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Terakhir Login</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data pengguna</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($users as $user): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($user['username']) ?></td>
                                <td><?= esc($user['nama_lengkap']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'petugas' ? 'warning text-dark' : 'info text-dark') ?>">
                                        <?= strtoupper($user['role']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user['aktif']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $user['last_login'] ? date('d M Y H:i', strtotime($user['last_login'])) : '-' ?>
                                </td>
                                <td>
                                    <?php if ($user['id'] != session()->get('user_id')): ?>
                                        <!-- Form Ubah Role -->
                                        <form action="<?= base_url('admin/pengguna/ubah-role/' . $user['id']) ?>" method="post" class="d-inline">
                                            <div class="input-group input-group-sm mb-1">
                                                <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                    <option value="petugas" <?= $user['role'] === 'petugas' ? 'selected' : '' ?>>Petugas</option>
                                                    <option value="anggota" <?= $user['role'] === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                                </select>
                                            </div>
                                        </form>

                                        <!-- Form Toggle Aktif -->
                                        <form action="<?= base_url('admin/pengguna/toggle-aktif/' . $user['id']) ?>" method="post" class="d-inline">
                                            <button type="submit" class="btn btn-sm w-100 <?= $user['aktif'] ? 'btn-outline-danger' : 'btn-outline-success' ?>" onclick="return confirm('Apakah Anda yakin ingin <?= $user['aktif'] ? 'menonaktifkan' : 'mengaktifkan' ?> pengguna ini?')">
                                                <i class="bi <?= $user['aktif'] ? 'bi-x-circle' : 'bi-check-circle' ?>"></i>
                                                <?= $user['aktif'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">Akun Anda</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
