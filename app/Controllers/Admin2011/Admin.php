<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{
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
    public function add() {
        
    }
}
