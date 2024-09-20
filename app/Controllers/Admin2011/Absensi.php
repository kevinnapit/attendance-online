<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\AdminModel;

class Absensi extends BaseController
{

    var $absensi;
    function __construct()
    {
        $this->absensi = new PresensiModel();
    }
    public function index()
    {
        // Inisialisasi model admin
        $adminModel = new AdminModel();

        // Misalkan kita ambil admin yang sedang login (ganti dengan session id jika ada)
        $admin = $adminModel->where('username', session()->get('username'))->first(); // ganti sesuai kondisi

        // Cek jika admin ditemukan
        if ($admin) {
            $data = [
                'id' => $admin['id'],
                'lokasi' => $this->absensi->datakantor() // kirimkan id ke view
            ];
        } else {
            $data = [
                'id' => null,
                'lokasi'=> null
            ];
        }

        return view('admin/absensi/index', $data);
    }
    public function submit()
    {
        $presensiModel = new PresensiModel();

        $userId = $this->request->getPost('id');
        $currentDate = date('Y-m-d');

        // Cek apakah user sudah absen masuk hari ini
        $absenMasuk = $presensiModel->where('id', $userId)
            ->where('tgl_presensi', $currentDate)
            ->where('jam_in IS NOT NULL')
            ->first();

        if ($absenMasuk && $absenMasuk['jam_out'] == null) {
            // Absensi Pulang
            $data = [
                'jam_out' => $this->request->getPost('jam_out'),
                'lokasi_out' => $this->request->getPost('lokasi_out'),
                'foto_out' => $this->saveImage($this->request->getPost('foto_out')),
            ];

            // Update absensi pulang
            $presensiModel->update($absenMasuk['id_presensi'], $data);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Absensi pulang berhasil!']);
        } else {
            // Absensi Masuk
            $data = [
                'id' => $userId, // Foreign key user
                'tgl_presensi' => $currentDate,
                'jam_in' => $this->request->getPost('jam_in'),
                'lokasi_in' => $this->request->getPost('lokasi_in'),
                'foto_in' => $this->saveImage($this->request->getPost('foto_in')),
            ];

            // Simpan absensi masuk
            $presensiModel->insert($data);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Absensi masuk berhasil!']);
        }
    }

    private function saveImage($imageData)
    {
        list($type, $imageData) = explode(';', $imageData);
        list(, $imageData) = explode(',', $imageData);
        $imageData = base64_decode($imageData);

        $fileName = uniqid() . '.jpg';
        $filePath = WRITEPATH . 'absensi/' . $fileName;

        file_put_contents($filePath, $imageData);

        return $fileName;
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
