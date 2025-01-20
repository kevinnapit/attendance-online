<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\FolderModel;
use App\Models\FileModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Arsip extends BaseController
{
    use ResponseTrait;
    var $model, $folder, $file, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->folder = new FolderModel();
        $this->file = new FileModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function add_folder($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $folder = $this->folder->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah folder",
                'detail' => $user,
                'folder' => $folder,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah folder"
            ];

            return view('admin/auth/arsip/addfolder', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    public function add_file($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $file = $this->file->where('id_user', $id)->findAll();

            $data = [
                'title' => "Tambah file",
                'detail' => $user,
                'file' => $file,
                'action' => "add",
                'alert' => "",
                'tombol' => "+ Tambah file"
            ];

            return view('admin/auth/arsip/addfile', $data);
        } else {
            return redirect()->to('/admin')->with('error', 'Pengguna tidak ditemukan.');
        }
    }

    public function savefolder()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'kategori' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        // Menyimpan data dari form
        $data = [
            'kategori' => $this->request->getPost('kategori')
        ];

        // Menangani file upload
        if ($this->request->getFile('attachment')->isValid()) {
            $attachment = $this->request->getFile('attachment');
            $fileName = $attachment->getRandomName(); // Menghasilkan nama file acak

            // Menyimpan file ke direktori
            $attachment->move(ROOTPATH . 'public/uploads/folder', $fileName);
            $data['attachment'] = $fileName; // Menyimpan nama file di database
        }

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->folder->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data folder berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data folder']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->folder->save($data)) {
                return $this->response->setJSON(['message' => 'Data folder berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data folder']);
            }
        }
    }
    public function savefile()
    {
        $action = $this->request->getPost('action');
        $id = $this->request->getPost('id');

        // Validasi form
        if (!$this->validate([
            'attachments' => 'uploaded[attachments]|max_size[attachments,1024]|ext_in[attachments,jpg,jpeg,png,pdf]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'File harus di-upload dan formatnya valid!');
        }

        // Menyimpan data dari form
        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'attachments' => $this->request->getPost('attachments')
        ];

        // Menangani file upload
        if ($this->request->getFile('attachments')->isValid()) {
            $attachments = $this->request->getFile('attachments');
            $fileName = $attachments->getName(); // Mendapatkan nama asli file

            // Cek apakah file sudah ada di folder uploads/file
            $filePath = ROOTPATH . 'public/uploads/file/' . $fileName;
            if (file_exists($filePath)) {
                $fileName = time() . '-' . $fileName;
                $filePath = ROOTPATH . 'public/uploads/file/' . $fileName;
            }

            // Menyimpan file ke direktori
            $attachments->move(ROOTPATH . 'public/uploads/file', $fileName);
            $data['attachments'] = $fileName; // Menyimpan nama file yang baru di database
        } else {
            return redirect()->back()->withInput()->with('error', 'File tidak valid atau gagal di-upload');
        }

        // Proses Tambah atau Update Data
        if ($action == 'update') {
            // Update data
            if ($this->file->update($id, $data)) {
                return $this->response->setJSON(['message' => 'Data file berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal memperbarui data file']);
            }
        } else {
            // Tambah data
            $data['id_user'] = $this->request->getPost('id_user'); // Menambahkan ID pengguna untuk data baru
            if ($this->file->save($data)) {
                return $this->response->setJSON(['message' => 'Data file berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['message' => 'Gagal menambah data file']);
            }
        }
    }
    public function detail($id)
    {
        $user = $this->model->find($id);
        $folder = $this->folder->find($id);
        $file = $this->file->find($id);

        if ($folder) {
            $data = [
                'user' => $user,
                'title' => 'Detail Folder',
                'folder' => $folder,
                'file' => $file
            ];
            return view('admin/auth/arsip/detail', $data);
        } else {
            return redirect()->to('/folder')->with('error', 'Folder tidak ditemukan.');
        }
    }

    function deletefolder($id)
    {
        $deleted = $this->folder->delete($id);
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
    function deletefile($id)
    {
        $deleted = $this->file->delete($id);
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
