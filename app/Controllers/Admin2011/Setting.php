<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DiskusiModel;
use CodeIgniter\Config\Config;
use App\Models\ModelSetting;

class Setting extends BaseController
{
    var $model;
    function __construct()
    {
        $this->model = new ModelSetting();
    }
    public function index()
    {
        $data = [
            'setting' => $this->model->datasetting()
        ];
        return view('admin/setting/index', $data);
    }
    public function updateSetting()
    {
        $data = [
            'nama_kantor' => $this->request->getPost('nama_kantor'),
            'alamat' => $this->request->getPost('alamat'),
            'lokasi_kantor' => $this->request->getPost('lokasi_kantor'),
            'radius' => $this->request->getPost('radius'),
        ];
        $this->model->updatesetting($data);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('admin2011/setting');
    }
}
