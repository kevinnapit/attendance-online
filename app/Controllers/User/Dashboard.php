<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PresensiModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;
use Carbon\Carbon;


class Dashboard extends BaseController
{
    var $presensi, $session;
    function __construct()
    {

        $this->presensi =  new PresensiModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $id_user = $this->session->get('user_id'); // Ambil id_user dari session
        $presensiModel = new PresensiModel();

        $presensi = $presensiModel->getJamByUserId($id_user);
        $kehadiran = $presensiModel->getKehadiranByUserId($id_user);
        $keterlambatan = $presensiModel->hitungKeterlambatan($id_user);
        $data['kehadiran'] = $kehadiran; // Kirim data ke view
        $data['keterlambatan'] = $keterlambatan; // Kirim ke view

        if ($presensi) {
            $created_at = new Carbon($presensi['created_at']);

            $now = Carbon::now();
            $diff = $created_at->diffInHours($now);

            if ($diff >= 24) {
                $status = 'Anda belum melakukan absensi';
            } else {
                $status = 'Absensi Anda sudah tercatat';
            }

            $data['status'] = $status;
            $data['presensi'] = $presensi;
        } else {
            $data['status'] = 'Anda belum melakukan absensi';
            $data['presensi'] = null;
        }

        return view('front/dashboard', $data);
    }
}
