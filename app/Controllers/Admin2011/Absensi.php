<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\AdminModel;
use App\Models\ModelSetting;

class Absensi extends BaseController
{

    var $absensi, $setting, $model;
    function __construct()
    {
        $this->absensi = new PresensiModel();
        $this->setting = new ModelSetting();
        $this->model = new AdminModel();
    }
    public function index()
    {
        $tgl_hari_ini = date("Y-m-d");
        $username = session()->get('admin_username');
        $data['title'] = "Edit Data Admin";
        $data['detail'] = [];
        $data['lokasi'] = $this->setting->datakantor();

        $data['status'] = $this->absensi->where('tgl_presensi', $tgl_hari_ini)->where('username', $username)->countAllResults();

        return view('admin/absensi/index', $data);
    }
    public function submit()
    {
        $username = session()->get('admin_username');
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasi = $this->request->getPost('lokasi');
        $kantor = $this->setting->datakantor();
        $latitudekantor = 2.3274844787258653;
        $longitudekantor = 99.05082584612623;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak['meters']);

        $image = $this->request->getPost('image');


        if (!$image || !$lokasi) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Invalid data']);
        }

        $folderPath = ROOTPATH . 'public/' . getenv('dir.upload.upload');
        $image_parts = explode(";base64,", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . ".png";
        $file = $folderPath . $fileName;

        $cek = $this->absensi->where('tgl_presensi', $tgl_presensi)->where('username', $username)->countAllResults();

        if ($radius > 10) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Anda Berada Diluar Radius']);
        } else {
            if ($cek > 0) {
                // Process "absen pulang" (update)
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = $this->absensi->where('tgl_presensi', $tgl_presensi)
                    ->where('username', $username)
                    ->set($data_pulang)
                    ->update();

                if ($update) {
                    if (file_put_contents($file, $image_base64)) {
                        return $this->response->setJSON(['status' => 'success', 'message' => 'Berhasil Absensi Pulang']);
                    } else {
                        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan file']);
                    }
                } else {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data']);
                }
            } else {
                // Process "absen masuk" (insert)
                $data = [
                    'username' => $username,
                    'tgl_presensi' => $tgl_presensi,
                    'lokasi_' => $lokasi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];

                $simpan = $this->absensi->insert($data);

                if ($simpan) {
                    if (file_put_contents($file, $image_base64)) {
                        return $this->response->setJSON(['status' => 'success', 'message' => 'Data dan file berhasil disimpan']);
                    } else {
                        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan file']);
                    }
                } else {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data']);
                }
            }
        }
    }



    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }


    public function checkstatus()
    {
        $presensiModel = new PresensiModel();
        $userId = $this->request->getPost('id');
        $currentDate = date('Y-m-d');

        // Cek absensi masuk
        $absenMasuk = $presensiModel->where('id', $userId)
            ->where('tgl_presensi', $currentDate)
            ->where('jam_in IS NOT NULL')
            ->first();

        if ($absenMasuk && $absenMasuk['jam_out'] == null) {
            return $this->response->setJSON(['status' => 'masuk']);
        } else {
            return $this->response->setJSON(['status' => 'belum_masuk']);
        }
    }
}
