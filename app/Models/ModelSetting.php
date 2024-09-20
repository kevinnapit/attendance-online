<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetting extends Model
{
    protected $table            = 'setting';
    protected $primaryKey       = 'id_setting';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kantor', 'alamat', 'lokasi_kantor', 'radius'];
    public function datakantor()
    {
        return $this->db->table('setting')
            ->where('id_setting', 1)->get()->getRowArray();
    }
}
