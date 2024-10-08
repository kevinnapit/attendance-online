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
        return $this->where('id_setting', 1)->get()->getRowArray();
    }
    public function updatesetting($data)
    {
        // Assuming 'id_setting' is always 1, you can adjust if necessary
        return $this->update(1, $data);
    }
}
