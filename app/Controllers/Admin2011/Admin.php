<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Admin extends BaseController
{
    use ResponseTrait;
    var $model, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function index()
    {
        return view('admin/auth/admin_list');
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

        $totalRecords = $db->table('tb_admin')->countAll();

        $totalRecordsWithFilter = $db->table('tb_admin')
            ->where('id !=', '0')
            ->like('name', $searchValue)
            ->orLike('username', $searchValue)
            ->orLike('email', $searchValue)
            ->countAllResults();

        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $db->table('tb_admin')
            ->select('*')
            ->where('id !=', '0')
            ->like('name', $searchValue)
            ->orLike('username', $searchValue)
            ->orLike('email', $searchValue)
            ->orderBy($orderBy)
            ->limit($rowperpage, $row)
            ->get()
            ->getResult();

        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecordsWithFilter,
            'iTotalDisplayRecords' => $totalRecords,
            'aaData' => $data
        ];

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
                    'role' => $this->request->getVar('role'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
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
                    'role' => $this->request->getVar('role'),
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
        $data['title'] = "Tambah Admin";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah Admin";
        echo view('admin/auth/admin_add', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit Data Admin";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/admin_add', $data);
    }
}
