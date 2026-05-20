<?php 
namespace App\Controllers; 
  
use App\Models\UserModel; 
  
class Akun extends BaseController 
{ 
    public function gantiPassword(): string 
    { 
        return view('akun/ganti_password', ['title' => 'Ganti Password']); 
    } 
  
    public function prosesGantiPassword() 
    { 
        $rules = [ 
            'password_lama' => [ 
                'label' => 'Password Lama', 
                'rules' => 'required', 
            ], 
            'password_baru' => [ 
                'label' => 'Password Baru', 
                'rules' => 'required|min_length[8]', 
                'errors'=> ['min_length' => 'Password baru minimal 8 karakter.'] 
            ], 
            'konfirmasi' => [ 
                'label' => 'Konfirmasi Password', 
                'rules' => 'required|matches[password_baru]', 
                'errors'=> ['matches' => 'Konfirmasi password tidak cocok dengan password baru.'] 
            ] 
        ]; 
  
        if (!$this->validate($rules)) { 
            return redirect()->back()->withInput() 
                             ->with('errors', $this->validator->getErrors()); 
        } 
  
        $userModel = new UserModel(); 
        $userId = session()->get('user_id'); 
        $user = $userModel->find($userId); 
  
        $passwordLama = $this->request->getPost('password_lama'); 
        if (!password_verify((string)$passwordLama, $user['password'])) { 
            return redirect()->back()->withInput() 
                             ->with('error', 'Password lama tidak sesuai.'); 
        } 
  
        $passwordBaru = $this->request->getPost('password_baru'); 
        $userModel->update($userId, [ 
            'password' => password_hash((string)$passwordBaru, PASSWORD_DEFAULT) 
        ]); 
  
        session()->setFlashdata('sukses', 'Password berhasil diubah.'); 
        return redirect()->to('/'); 
    } 
}
