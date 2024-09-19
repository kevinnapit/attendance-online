<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHome extends Model
{
    public function datakaryawan()
    {
        return $this->db->table('karyawan')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=karyawan.id_jabatan', 'LEFT')
            ->where('id_karyawan', session()->get('id_karyawan'))->get()->getRowArray();
    }
}
