<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AnakModel;
use App\Models\KeluargaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Keluarga extends BaseController
{
    use ResponseTrait;
    var $model, $anak, $keluarga, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->anak = new AnakModel();
        $this->keluarga = new KeluargaModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function add($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $keluarga = $this->keluarga->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah keluarga",
                'detail' => $user,
                'keluarga' => $keluarga,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah keluarga"
            ];

            return view('admin/auth/keluarga/add', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function edit($id)
    {
        $data['title'] = "Edit Data";
        $data['detail'] = $this->keluarga->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/keluarga/add', $data);
    }
    public function save()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'nama_pasangan' => 'required',
            'nik_pasangan' => 'required',
            'status_hidup_pasangan' => 'required',
            'tgl_lahir_pasangan' => 'required',
            'tgl_kawin' => 'required',
            'nama_mertua_lk' => 'required',
            'nik_mertua_lk' => 'required',
            'status_hidup_mertua_lk' => 'required',
            'nama_mertua_pr' => 'required',
            'nik_mertua_pr' => 'required',
            'status_hidup_mertua_pr' => 'required',
            'no_akta_kawin' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        // Menyimpan data dari form
        $data = [
            'nama_pasangan' => $this->request->getPost('nama_pasangan'),
            'nik_pasangan' => $this->request->getPost('nik_pasangan'),
            'status_hidup_pasangan' => $this->request->getPost('status_hidup_pasangan'),
            'tgl_lahir_pasangan' => $this->request->getPost('tgl_lahir_pasangan'),
            'tgl_kawin' => $this->request->getPost('tgl_kawin'),
            'nama_mertua_lk' => $this->request->getPost('nama_mertua_lk'),
            'nik_mertua_lk' => $this->request->getPost('nik_mertua_lk'),
            'status_hidup_mertua_lk' => $this->request->getPost('status_hidup_mertua_lk'),
            'nama_mertua_pr' => $this->request->getPost('nama_mertua_pr'),
            'nik_mertua_pr' => $this->request->getPost('nik_mertua_pr'),
            'status_hidup_mertua_pr' => $this->request->getPost('status_hidup_mertua_pr'),
            'no_akta_kawin' => $this->request->getPost('no_akta_kawin'),
        ];

        // Menangani file upload
        if ($this->request->getFile('attachment')->isValid()) {
            $attachment = $this->request->getFile('attachment');
            $fileName = $attachment->getRandomName(); // Menghasilkan nama file acak

            // Menyimpan file ke direktori
            $attachment->move(ROOTPATH . 'public/uploads/file', $fileName);
            $data['attachment'] = $fileName; // Menyimpan nama file di database
        }

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->keluarga->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data keluarga berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data keluarga']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->keluarga->save($data)) {
                return $this->response->setJSON(['message' => 'Data keluarga berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data keluarga']);
            }
        }
    }



    function delete($id)
    {
        $deleted = $this->keluarga->delete($id);
        if ($deleted) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ], 200);
        } else {
            return $this->respond([
                'message' => 'Ops! Id tidak valid'
            ], 400);
        }
    }
    public function addanak($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $anak = $this->anak->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah anak",
                'detail' => $user,
                'anak' => $anak,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah anak"
            ];

            return view('admin/auth/keluarga/addanak', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function editanak($id)
    {
        $data['title'] = "Edit Data";
        $data['detail'] = $this->anak->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/keluarga/addanak', $data);
    }
    public function saveanak()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'nama_anak' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required',
            'anak_ke' => 'required|integer',
            'nomor_akta' => 'required',
            'tgl_akta' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        // Menyimpan data dari form
        $data = [
            'nama_anak' => $this->request->getPost('nama_anak'),
            'nik' => $this->request->getPost('nik'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'anak_ke' => $this->request->getPost('anak_ke'),
            'nomor_akta' => $this->request->getPost('nomor_akta'),
            'tgl_akta' => $this->request->getPost('tgl_akta'),
        ];

        // Menangani file upload
        if ($this->request->getFile('attachment')->isValid()) {
            $attachment = $this->request->getFile('attachment');
            $fileName = $attachment->getRandomName(); // Menghasilkan nama file acak

            // Menyimpan file ke direktori
            $attachment->move(ROOTPATH . 'public/uploads/file', $fileName);
            $data['attachment'] = $fileName; // Menyimpan nama file di database
        }

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->anak->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data anak berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data anak']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->anak->save($data)) {
                return $this->response->setJSON(['message' => 'Data anak berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data anak']);
            }
        }
    }


    function deleteanak($id)
    {
        $deleted = $this->anak->delete($id);
        if ($deleted) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ], 200);
        } else {
            return $this->respond([
                'message' => 'Ops! Id tidak valid'
            ], 400);
        }
    }
}
