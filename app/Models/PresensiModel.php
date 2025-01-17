<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'tbl_presensi';
    protected $primaryKey       = 'id_presensi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'username', 'tgl_presensi', 'jam_in', 'jam_out', 'lokasi_in', 'lokasi_out', 'foto_in', 'foto_out', 'created_at', 'updated_at'];

    public function getJamByUserId($id_user)
    {
        return $this->select('jam_in, jam_out,created_at')
            ->where('id', $id_user)
            ->first(); // Ambil data pertama yang cocok dengan id_user
    }

    public function cekabsensi($id_karyawan, $tanggal)
    {
        return $this->db->table('tbl_presensi')
            ->where('id_karyawan', $id_karyawan)
            ->where('tgl_presensi', $tanggal)
            ->get()->getRowArray();
    }

    //menghitung jumlah kehadiran dan di update setiap bulan
    public function getKehadiranByUserId($id_user)
    {
        // Ambil bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Hitung jumlah kehadiran
        return $this->where('id', $id_user)
            ->where('jam_in IS NOT NULL') // Pastikan sudah absen masuk
            ->where('jam_out IS NOT NULL') // Pastikan sudah absen keluar
            ->where('MONTH(tgl_presensi)', $currentMonth) // Filter bulan
            ->where('YEAR(tgl_presensi)', $currentYear)   // Filter tahun
            ->countAllResults(); // Hitung jumlah baris
    }

    public function hitungKeterlambatan($id_user)
    {
        // Ambil data jam masuk berdasarkan id_user
        $presensi = $this->select('jam_in')
            ->where('id', $id_user)
            ->where('DATE(tgl_presensi)', date('Y-m-d')) // Hanya untuk hari ini
            ->first();

        // Jika tidak ada data jam masuk, dianggap tidak terlambat
        if (!$presensi || empty($presensi['jam_in'])) {
            return '-,-,-';
        }

        // Waktu masuk kantor
        $waktuMasukKantor = '09:30:00';

        // Hitung selisih waktu (menggunakan Carbon atau PHP DateTime)
        $jamIn = new \DateTime($presensi['jam_in']);
        $jamMasuk = new \DateTime($waktuMasukKantor);

        // Periksa apakah terlambat
        if ($jamIn > $jamMasuk) {
            $selisih = $jamIn->diff($jamMasuk);
            return $selisih->format('%h jam %i menit');
        } else {
            return 'Tepat waktu';
        }
    }
}
