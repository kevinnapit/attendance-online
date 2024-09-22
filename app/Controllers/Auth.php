
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AuthModel;

class Auth extends BaseController
{
    var $model;
    function __construct()
    {
        $this->model = new AuthModel();
    }
    public function index()
    {
        return view('front/auth/login');
    }
    public function ceklogin_karyawan()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong!!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'Errors' => [
                    'required' => '{field} Tidak boleh kosong!!'
                ]
            ]

        ])) {
            $username = $this->request->getPost('username');
            $password = sha1($this->request->getPost('password'));

            $cek = $this->model->loginKaryawan($username, $password);
            if ($cek) {
                session()->set('id_karyawan', $cek['id_karyawan']);
                session()->set('level', 2);
                return redirect()->to('Home');
            } else {
                session()->setFlashdata('pesan', 'Username atau Password Salah!!');
                return redirect()->to('Auth');
            }
        } else{
            return redirect()->to('Auth')->withInput();
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
