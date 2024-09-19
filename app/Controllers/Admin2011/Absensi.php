<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\PresensiModel;

class Absensi extends BaseController {

    var $absensi;
    function __construct()
    {
        $this->absensi = new PresensiModel();
    }
    public function index(){
        $data = [
            'lokasi' => $this->absensi->datakantor()
        ];
        return view('admin/absensi/index',$data);
    }
}
 