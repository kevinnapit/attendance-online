<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;

class Presensi extends BaseController
{
    protected $modelpresensi;
    function __construct()
    {
        $this->modelpresensi = new PresensiModel();
    }
    public function index()
    {
        $id_karyawan = session()->get('id_karyawan');
        $tanggal = date('Y-m-d');
        $presensi = $this->modelpresensi->cekabsensi($id_karyawan,$tanggal);
        if ($presensi) {
            //buka absen masuk
            $data = [
                'judul' => 'Absen Pulang',
                'menu' => 'presensi',
                'page' => 'front/auth/absensiPulang',
                'kantor' => $this->modelpresensi->datakantor(),
            ];
        } else {
            $data = [
                'judul' => 'Absensi Masuk',
                'menu' => 'presensi',
                'page' => 'front/auth/absensimasuk',
                'kantor' => $this->modelpresensi->datakantor(),
            ];
           
        }
        return view('front/layout/main',$data);
    }
}
