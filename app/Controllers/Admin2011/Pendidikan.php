<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PendidikanModel;
use App\Models\TugasBelajarModel;
use App\Models\PangkatModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Pendidikan extends BaseController
{
    use ResponseTrait;
    var $model, $pendidikan, $belajar, $pangkat, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->pendidikan = new PendidikanModel();
        $this->belajar = new TugasBelajarModel();
        $this->pangkat = new PangkatModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function addpendidikan($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $pendidikan = $this->pendidikan->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah Pendidikan",
                'detail' => $user,
                'pendidikan' => $pendidikan,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah Pendidikan"
            ];

            return view('admin/auth/pendidikan/add', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function editpendidikan($id)
    {
        $data['title'] = "Edit Data halo";
        $data['detail'] = $this->pendidikan->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/pendidikan/add', $data);
    }
    public function savePendidikan()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'jenjang' => 'required',
            'pendidikan' => 'required',
            'institusi' => 'required',
            'nomor_ijazah' => 'required',
            'lulus' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        $data = [
            'jenjang' => $this->request->getPost('jenjang'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'institusi' => $this->request->getPost('institusi'),
            'nomor_ijazah' => $this->request->getPost('nomor_ijazah'),
            'lulus' => $this->request->getPost('lulus')
        ];

        if ($action == 'update') {
            // Update data
            if ($this->pendidikan->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data pendidikan berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data pendidikan']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->pendidikan->save($data)) {
                return $this->response->setJSON(['message' => 'Data pendidikan berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data pendidikan']);
            }
        }
    }
    function deletependidikan($id)
    {
        $deleted = $this->pendidikan->delete($id);
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

    //batas pendidikan

    public function addpeningkatan($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $peningkatan = $this->belajar->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah",
                'detail' => $user,
                'peningkatan' => $peningkatan,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah"
            ];

            return view('admin/auth/pendidikan/addpeningkatan', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    function editpeningkatan($id)
    {
        $data['title'] = "Edit Data";
        $data['detail'] = $this->belajar->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/pendidikan/addpeningkatan', $data);
    }

    public function savepeningkatan()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'jenjang' => 'required',
            'pendidikan' => 'required',
            'institusi' => 'required',
            'jenis_peningkatan' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        $data = [
            'jenjang' => $this->request->getPost('jenjang'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'institusi' => $this->request->getPost('institusi'),
            'jenis_peningkatan' => $this->request->getPost('jenis_peningkatan'),
            'nomor_sk' => $this->request->getPost('nomor_sk'),
            'tanggal_sk' => $this->request->getPost('tanggal_sk')
        ];

        if ($action == 'update') {
            // Update data
            if ($this->belajar->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data peningkatan berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data peningkatan']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->belajar->save($data)) {
                return $this->response->setJSON(['message' => 'Data peningkatan berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data peningkatan']);
            }
        }
    }

    function deletepeningkatan($id)
    {
        $deleted = $this->belajar->delete($id);
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

    // batas peningkatan

   
}
