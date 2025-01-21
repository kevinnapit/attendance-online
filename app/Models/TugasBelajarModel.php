<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasBelajarModel extends Model
{
    protected $table      = 'tbl_tugasbelajar';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_user',
        'jenjang',
        'pendidikan',
        'institusi',
        'jenis_peningkatan',
        'nomor_sk',
        'tanggal_sk'
    ];

    // Validation rules
    protected $validationRules = [];

    protected $validationMessages = [];

    protected $skipValidation = false;
}
