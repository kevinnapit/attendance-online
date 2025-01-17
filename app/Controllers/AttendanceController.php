<?php

namespace App\Controllers;

class AttendanceController extends BaseController
{
    // Fungsi untuk menampilkan halaman sukses absensi
    public function success()
    {
        return view('attsuccess');
    }
}
