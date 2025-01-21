<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
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
    public function login()
    {
        // Jika ada cookie yang tersimpan dan password tidak bernilai '1'
        if (get_cookie('admin_cookie_username') && get_cookie('admin_cookie_password') && (get_cookie('admin_cookie_password') != '1')) {
            $username = get_cookie('admin_cookie_username');
            $password = get_cookie('admin_cookie_password');
            $dataAkun = $this->model->getData($username);

            // Verifikasi password jika tidak cocok
            if (!password_verify($password, $dataAkun['password'])) {
                set_cookie("admin_cookie_failed", '1', 3600);
                $err[] = "Ops! Terjadi kesalahan";
                return redirect()->to('admin2011/login');
            }

            // Cek apakah isLogin == 0 (belum diverifikasi)
            if ($dataAkun['isLogin'] == 0) {
                $err[] = "Admin belum verifikasi akun anda";
                session()->setFlashdata('warning', $err);
                return redirect()->to('admin2011/login');
            }

            // Set session data jika berhasil login
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
            // Cek role dan redirect
            return redirect()->to('admin2011/dashboard');
        }

        // Inisialisasi array untuk error
        $data = [];

        // Jika metode request adalah POST
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

            // Validasi form input
            if (!$this->validate($rules)) {
                session()->setFlashdata("warning", $this->validation->getErrors());
                return redirect()->to("admin2011/login");
            }

            // Ambil data form
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');

            // Ambil data akun dari database berdasarkan username
            $dataAkun = $this->model->getData($username);

            // Jika username tidak ditemukan
            if (!isset($dataAkun['username'])) {
                $err[] = "Username tidak ditemukan.";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to("admin2011/login");
            }

            // Verifikasi password
            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = "Password yang di masukkan salah.";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to("admin2011/login");
            }

            // Cek apakah akun sudah diverifikasi (isLogin = 0)
            if ($dataAkun['isLogin'] == 0) {
                $err[] = "Admin Belum Verifikasi Akun Anda";
                session()->setFlashdata('warning', $err);
                return redirect()->to("admin2011/login");
            }

            // Jika remember_me dicentang, simpan cookie
            if ($remember_me == '1') {
                set_cookie("admin_cookie_username", $username, 3600 * 24 * 30);
                set_cookie("admin_cookie_password", $password, 3600 * 24 * 30);
            }

            // Set session data
            $akun = [
                'admin_username' => $dataAkun['username'],
                'admin_name' => $dataAkun['name'],
                'admin_email' => $dataAkun['email'],
                'admin_role' => $dataAkun['role'],
                'admin_id' => $dataAkun['id'],
                'user_id' => $dataAkun['id']
            ];
            session()->set($akun);
            // Cek role dan redirect
            return redirect()->to('admin2011/dashboard');
        }

        // Render tampilan login
        echo view("admin/auth/login", $data);
    }



    function logout()
    {
        delete_cookie("admin_cookie_username");
        delete_cookie("admin_cookie_password");
        session()->destroy();
        if (session()->get('admin_username') != '') {
            session()->setFlashdata("success", "Anda berhasil logout");
        }
        echo view("admin/auth/login");
    }

    function lupapassword()
    {
        $err = [];
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getVar('username');
            if ($username == '') {
                $err[] = "Silakan masukkan username atau email yang anda punya";
            }
            if (empty($err)) {
                $data = $this->model->getData($username);
                if (empty($data)) {
                    $err[] = "Akun yang kamu masukkan tidak terdata";
                }
            }
            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));

                $link = site_url("admin2045/resetpassword/?email=$email&token=$token");
                $attachment = "";
                $to = $email;
                $title = "Reset Password";
                $message = "Berikut ini adalah link untuk melakukan reset password Anda.";
                $message .= "Silakan klik link berikut ini $link";

                // kirim_email($attachment, $to, $title, $message);

                $dataUpdate = [
                    'email' => $email,
                    'token' => $token
                ];
                $this->model->updateData($dataUpdate);
                session()->setFlashdata("success", "Email untuk recovery sudah kami kirimkan ke email anda");
            }
            if ($err) {
                session()->setFlashdata("username", $username);
                session()->setFlashdata("warning", $err);
            }
            return redirect()->to("admin2011/lupapassword");
        }
        echo view("admin/auth/forgot_password");
    }
    function resetpassword()
    {
        $err = [];
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if ($email != '' and $token != '') {
            $dataAkun = $this->model->getData($email); //<-- cek di tabel admin
            if ($dataAkun['token'] != $token) {
                $err[] = "Token tidak valid";
            }
        } else {
            $err[] = "Parameter yang dikirimkan tidak valid";
        }

        if ($err) {
            session()->setFlashdata("warning", $err);
        }

        if ($this->request->getMethod() == 'post') {
            $aturan = [
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Panjang karakter minimum untuk password adalah 5 karakter'
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[5]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi',
                        'min_length' => 'Panjang karakter minimum untuk konfirmasi password adalah 5 karakter',
                        'matches' => 'Konfirmasi password tidak sesuai dengan password yang diisikan'
                    ]
                ]
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $dataUpdate = [
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                    'token' => null
                ];
                $this->model->updateData($dataUpdate);
                session()->setFlashdata('success', 'Password berhasil direset, silakan login');

                delete_cookie('admin_cookie_username');
                delete_cookie('admin_cookie_password');

                return redirect()->to('admin2011/login')->withCookies();
            }
        }

        echo view("admin/auth/reset_password");
    }
}
