<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AuthModel;

class Auth extends BaseController
{
    var $model, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function login()
    {
        if (get_cookie('admin_cookie_username') && get_cookie('admin_cookie_password') && (get_cookie('admin_cookie_password') != '1')) {
            $username = get_cookie('admin_cookie_username');
            $password = get_cookie('admin_cookie_password');
            $dataAkun = $this->model->getData($username);
            if (!password_verify($password, $dataAkun['password'])) {
                set_cookie("admin_cookie_failed", '1', 3600);
                $err[] = "Ops! Terjadi kesalahan";
                return redirect()->to('admin2011/login');
            }
            $akun = [
                'admin_username' => $username,
                'username' => $dataAkun['username'],
                'admin_name' => $dataAkun['name'],
                'admin_email' => $dataAkun['email'],
                'admin_role' => $dataAkun['role'],
                'admin_id' => $dataAkun['id'],
                'user_id' => $dataAkun['id']

            ];
            session()->set($akun);
            return redirect()->to('home/');
        }
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username harus diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata("warning", $this->validation->getErrors());
                return redirect()->to("admin2011/login");
            }
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');

            $dataAkun = $this->model->getData($username);
            if (!isset($dataAkun['username'])) {
                $err[] = "Username tidak ditemukan.";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to("admin2011/login");
            }
            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = "Password yang di masukkan salah.";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to("admin2011/login");
            }

            if ($remember_me == '1') {
                set_cookie("admin_cookie_username", $username, 3600 * 24 * 30);
                set_cookie("admin_cookie_password", $password, 3600 * 24 * 30);
            }

            $akun = [
                'admin_username' => $dataAkun['username'],
                'admin_name' => $dataAkun['name'],
                'admin_email' => $dataAkun['email'],
                'admin_role' => $dataAkun['role'],
                'admin_id' => $dataAkun['id'],
                'user_id' => $dataAkun['id']
            ];
            session()->set($akun);
            return redirect()->to("home/")->withCookies();
        }
        echo view("front/auth/login", $data);
    }
    public function logout()
    {
        delete_cookie("user_cookie_username");
        delete_cookie("user_cookie_password");
        session()->destroy();
        if (session()->get('user_username') != '') {
            session()->setFlashdata("success", "Anda berhasil logout");
        }
        echo view('front/auth/login');
    }
}
