<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Pengguna extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $this->userModel->getDaftarUser(),
            'breadcrumb' => [
                ['label' => 'Admin', 'url' => base_url('admin')],
                ['label' => 'Pengguna', 'url' => base_url('admin/pengguna')]
            ]
        ];

        return view('admin/pengguna/index', $data);
    }

    public function toggleAktif($id)
    {
        // Proteksi: admin tidak bisa menonaktifkan akun miliknya sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $user = $this->userModel->find($id);
        if ($user) {
            $statusBaru = $user['aktif'] ? 0 : 1;
            $this->userModel->update($id, ['aktif' => $statusBaru]);
            $pesan = $statusBaru ? 'Akun pengguna berhasil diaktifkan.' : 'Akun pengguna berhasil dinonaktifkan.';
            return redirect()->back()->with('sukses', $pesan);
        }

        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }

    public function ubahRole($id)
    {
        // Proteksi: admin tidak bisa mengubah role akun miliknya sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri.');
        }

        $user = $this->userModel->find($id);
        if ($user) {
            $roleBaru = $this->request->getPost('role');
            if (in_array($roleBaru, ['admin', 'petugas', 'anggota'])) {
                $this->userModel->update($id, ['role' => $roleBaru]);
                return redirect()->back()->with('sukses', 'Role pengguna berhasil diubah.');
            } else {
                return redirect()->back()->with('error', 'Role tidak valid.');
            }
        }

        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }
}
