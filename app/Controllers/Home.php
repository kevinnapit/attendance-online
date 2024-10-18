<?php

namespace App\Controllers;
use App\Models\ModelHome;
class Home extends BaseController
{

    var $model;
    function __construct()
    {
        $this->model = new ModelHome();
    }
    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'menu' => 'home',
            'karyawan' => $this->model->datakaryawan()
        ];
        return view('front/web');
    }
}
