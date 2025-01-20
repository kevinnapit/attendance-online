<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PendidikanModel;
use App\Models\TugasBelajarModel;
use App\Models\PangkatModel;
use App\Models\MutasiModel;
use App\Models\DisiplinModel;
use App\Models\FolderModel;
use App\Models\FileModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Admin extends BaseController
{
    use ResponseTrait;
    var $model, $pendidikan, $belajar, $pangkat, $mutasi, $disiplin, $folder, $file, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->pendidikan = new PendidikanModel();
        $this->belajar = new TugasBelajarModel();
        $this->pangkat = new PangkatModel();
        $this->mutasi = new MutasiModel();
        $this->disiplin = new DisiplinModel();
        $this->folder = new FolderModel();
        $this->file = new FileModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function index()
    {
        return view('admin/auth/admin_list');
    }
    public function view($id)
    {
        // Memastikan ID adalah integer
        $user = $this->model->find($id);
        $pendidikan = $this->pendidikan->where('id_user', $id)->findAll();
        $pendidikan = $this->pendidikan->where('id_user', $id)->findAll();
        $belajar = $this->belajar->where('id_user', $id)->findAll();
        $pangkat = $this->pangkat->where('id_user', $id)->findAll();
        $mutasi = $this->mutasi->where('id_user', $id)->findAll();
        $disiplin = $this->disiplin->where('id_user', $id)->findAll();
        $folder = $this->folder->where('id_user', $id)->findAll();
        $file = $this->file->getFilesByCategoryZero($id);
        return view('admin/auth/user_detail', [
            'user' => $user,
            'pendidikan' => $pendidikan,
            'belajar' => $belajar,
            'pangkat' => $pangkat,
            'mutasi' => $mutasi,
            'disiplin' => $disiplin,
            'folder' => $folder,
            'file' => $file,
        ]);
    }

    public function loaddata()
    {
        $request = service('request');

        $draw = $request->getVar('draw');
        $row = $request->getVar('start');
        $rowperpage = $request->getVar('length');

        $columnIndex = $request->getVar('order')[0]['column'];
        $columnName = $request->getVar('columns')[$columnIndex]['data'];

        $columnSortOrder = $request->getVar('order')[0]['dir'];
        $searchValue = $request->getVar('search')['value'];

        $db = db_connect();

        // Total Records with 'role = user' filter
        $totalRecords = $db->table('tb_admin')
            ->where('role', 'user') // Filter only 'role = user'
            ->countAll();

        // Total Records with 'role = user' filter and search filter applied
        $totalRecordsWithFilter = $db->table('tb_admin')
            ->where('role', 'user') // Filter only 'role = user'
            ->groupStart() // Start grouping conditions
            ->like('name', $searchValue)
            ->orLike('username', $searchValue)
            ->orLike('email', $searchValue)
            ->groupEnd() // End grouping conditions
            ->countAllResults();

        // Sorting and ordering
        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;

        // Fetch the data with filter, pagination, and sorting (only 'role = user')
        $data = $db->table('tb_admin')
            ->select('*')
            ->where('role', 'user') // Filter only 'role = user'
            ->groupStart() // Start grouping conditions for search
            ->like('name', $searchValue)
            ->orLike('username', $searchValue)
            ->orLike('email', $searchValue)
            ->groupEnd() // End grouping conditions
            ->orderBy($orderBy)
            ->limit($rowperpage, $row)
            ->get()
            ->getResult();

        // Prepare response in JSON format
        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecordsWithFilter, // Total filtered records
            'iTotalDisplayRecords' => $totalRecords, // Total records with 'role = user'
            'aaData' => $data
        ];

        // Return the response as JSON
        return $this->response->setJSON($response);
    }


    function submitdata()
    {
        $action = $this->request->getVar('action');
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'email' => 'Email tidak valid',
                ]
            ],
            'picture' => [
                'rules' => 'max_size[picture,2048]|ext_in[picture,png,jpg,jpeg,gif]',
                'errors' => [
                    'max_size' => "Ukuran File Terlalu Besar",
                    'ext_in' => 'Tipe file tidak diizinkan',
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->respond(['errors' => $errors], 400);
        }

        switch ($action) {
            case "add":
                $rulesadd = [
                    'password' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Password harus diisi'
                        ]
                    ],
                    'username' => [
                        'rules' => 'required|is_unique[tb_admin.username]',
                        'errors' => [
                            'is_unique' => 'Username sudah digunakan',
                        ]
                    ],
                    'email' => [
                        'rules' => 'required|is_unique[tb_admin.email]|valid_email',
                        'errors' => [
                            'required' => 'Email harus diisi',
                            'email' => 'Email tidak valid',
                            'is_unique' => 'Email sudah digunakan',
                        ]
                    ],
                ];
                if (!$this->validate($rulesadd)) {
                    $errorsadd = $this->validator->getErrors();
                    return $this->respond(['errors' => $errorsadd], 400);
                }
                $requestData = array(
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'role' => 'user',  // Set role menjadi 'user' secara otomatis
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                    'isLogin' => 1  // Set isLogin menjadi 1 secara otomatis
                );

                $image = $this->request->getFile('picture');
                if ($image->isValid()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/' . getenv('dir.upload.upload'), $newName);
                    $requestData['picture'] = $newName;
                }

                $this->model->insert($requestData);

                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                ], 200);
            case "update":
                $requestData = array(
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'role' => $this->request->getVar('role') ?: 'user',  // Set default 'user' if 'role' is empty
                    'isLogin' => 1  // Set default isLogin to 1
                );

                if ($this->request->getVar('password') != "") {
                    $requestData['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
                }

                $detail = $this->model->find($this->request->getVar('id'));
                $image = $this->request->getFile('picture');
                if ($image->isValid()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/' . getenv('dir.upload.profile'), $newName);
                    $requestData['picture'] = $newName;
                    if ($detail['picture']) {
                        $imagePath = ROOTPATH . 'public/' . getenv('dir.upload.profile') . $detail['picture'];
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                $this->model->update($detail['id'], $requestData);
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                ], 200);
        }
    }

    function add()
    {
        $data['title'] = "Tambah User";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah User";
        echo view('admin/auth/admin_add', $data);
    }

    function edit($id)
    {
        $data['title'] = "Edit Data User";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/admin_add', $data);
    }
    function delete($id)
    {
        $deleted = $this->model->delete($id);
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

    public function updateIsLogin()
    {
        $id = $this->request->getPost('id');
        $isLogin = $this->request->getPost('isLogin');

        // Update isLogin value in the database
        $db = db_connect();
        $builder = $db->table('tb_admin');
        $builder->set('isLogin', $isLogin);
        $builder->where('id', $id);
        $builder->update();

        // Return success response
        return $this->response->setJSON(['message' => 'Status berhasil diperbarui']);
    }
}
