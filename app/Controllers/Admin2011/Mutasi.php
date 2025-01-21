<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MutasiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Mutasi extends BaseController
{
    use ResponseTrait;
    var $model, $mutasi, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->mutasi = new MutasiModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function add($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $pangkat = $this->mutasi->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah pangkat",
                'detail' => $user,
                'pangkat' => $pangkat,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah pangkat"
            ];

            return view('admin/auth/mutasi/add', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function edit($id)
    {
        $data['title'] = "Edit Data";
        $data['detail'] = $this->mutasi->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/mutasi/add', $data);
    }
    public function save()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'tmt' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required',
            'jabatan' => 'required',
            'eselon' => 'required',
            'unit_kerja' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        // Menyimpan data dari form
        $data = [
            'tmt' => $this->request->getPost('tmt'),
            'nomor_sk' => $this->request->getPost('nomor_sk'),
            'tanggal_sk' => $this->request->getPost('tanggal_sk'),
            'jabatan' => $this->request->getPost('jabatan'),
            'eselon' => $this->request->getPost('eselon'),
            'unit_kerja' => $this->request->getPost('unit_kerja'),
        ];

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->mutasi->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data mutasi berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data mutasi']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->mutasi->save($data)) {
                return $this->response->setJSON(['message' => 'Data mutasi berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data mutasi']);
            }
        }
    }

    function delete($id)
    {
        $deleted = $this->mutasi->delete($id);
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
