<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\DisiplinModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Disiplin extends BaseController
{
    use ResponseTrait;
    var $model, $disiplin, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->disiplin = new DisiplinModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function add($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $disiplin = $this->disiplin->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah disiplin",
                'detail' => $user,
                'disiplin' => $disiplin,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah disiplin"
            ];

            return view('admin/auth/disiplin/add', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function edit($id)
    {
        $data['title'] = "Edit Data";
        $data['detail'] = $this->disiplin->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/disiplin/add', $data);
    }
    public function save()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'jenis_hukuman' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        // Menyimpan data dari form
        $data = [
            'jenis_hukuman' => $this->request->getPost('jenis_hukuman'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai')
        ];

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->disiplin->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data hukuman berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data hukuman']);
            }
        } else {
            $data['id_user'] = $this->request->getPost('id_user');
            if ($this->disiplin->save($data)) {
                return $this->response->setJSON(['message' => 'Data hukuman berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data hukuman']);
            }
        }
    }


    function delete($id)
    {
        $deleted = $this->disiplin->delete($id);
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
