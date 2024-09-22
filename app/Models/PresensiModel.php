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
    protected $allowedFields    = ['id', 'username', 'tgl_presensi', 'jam_in', 'jam_out', 'lokasi_in', 'lokasi_out', 'foto_in', 'foto_out'];



    public function cekabsensi($id_karyawan, $tanggal)
    {
        return $this->db->table('tbl_presensi')
            ->where('id_karyawan', $id_karyawan)
            ->where('tgl_presensi', $tanggal)
            ->get()->getRowArray();
    }

}
