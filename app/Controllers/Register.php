<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;

class Register extends BaseController
{
    var $model, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function index()
    {
        echo view("admin/auth/register");
    }
    public function submit()
    {
        $name = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        $terms = $this->request->getPost('terms'); // Checkbox untuk terms

        if ($password !== $confirm_password) {
            return redirect()->back()->with('error', 'Password dan konfirmasi password tidak cocok');
        }

        if (!$terms) {
            return redirect()->back()->with('error', 'Anda harus menerima syarat dan ketentuan');
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Siapkan data untuk disimpan
        $data = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user',  // Secara otomatis memberi role 'user'
            'isLogin' => 0,  // Default isLogin 0
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan ke database
        if ($this->model->insert($data)) {
            return redirect()->to('/admin2011/login')->with('success', 'Pendaftaran berhasil');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat pendaftaran');
        }
    }
    
}
