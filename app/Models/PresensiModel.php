<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    public function cekabsensi($id_karyawan, $tanggal)
    {
        return $this->db->table('tbl_presensi')
            ->where('id_karyawan', $id_karyawan)
            ->where('tgl_presensi',$tanggal)
            ->get()->getRowArray();
    }
    public function datakantor()
    {
        return $this->db->table('setting')
            ->where('id_setting',1)->get()->getRowArray();
    }
}
