<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PangkatModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Pangkat extends BaseController
{
    use ResponseTrait;
    var $model, $pangkat, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->pangkat = new PangkatModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function add($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $pangkat = $this->pangkat->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah pangkat",
                'detail' => $user,
                'pangkat' => $pangkat,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah pangkat"
            ];

            return view('admin/auth/pangkat/add', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function edit($id)
    {
        $data['title'] = "Edit Data";
        $data['detail'] = $this->pangkat->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/pangkat/add', $data);
    }
    public function save()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'jenis_kp' => 'required',
            'tmt' => 'required',
            'golongan' => 'required',
            'mkg_thn' => 'required|integer',
            'mkg_bln' => 'required|integer',
            'angka_kredit' => 'required|numeric',
            'nomor_np_bkn' => 'required',
            'tanggal_np_bkn' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        // Menyimpan data dari form
        $data = [
            'jenis_kp' => $this->request->getPost('jenis_kp'),
            'tmt' => $this->request->getPost('tmt'),
            'golongan' => $this->request->getPost('golongan'),
            'mkg_thn' => $this->request->getPost('mkg_thn'),
            'mkg_bln' => $this->request->getPost('mkg_bln'),
            'angka_kredit' => $this->request->getPost('angka_kredit'),
            'nomor_np_bkn' => $this->request->getPost('nomor_np_bkn'),
            'tanggal_np_bkn' => $this->request->getPost('tanggal_np_bkn'),
            'nomor_sk' => $this->request->getPost('nomor_sk'),
            'tanggal_sk' => $this->request->getPost('tanggal_sk'),
        ];

        // Menangani file upload
        if ($this->request->getFile('attachments')->isValid()) {
            $attachment = $this->request->getFile('attachments');
            $fileName = $attachment->getRandomName(); // Menghasilkan nama file acak

            // Menyimpan file ke direktori
            $attachment->move(ROOTPATH . 'public/uploads/filepangkat', $fileName);
            $data['attachments'] = $fileName; // Menyimpan nama file di database
        }

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->pangkat->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data pangkat berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data pangkat']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->pangkat->save($data)) {
                return $this->response->setJSON(['message' => 'Data pangkat berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data pangkat']);
            }
        }
    }

    function delete($id)
    {
        $deleted = $this->pangkat->delete($id);
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
