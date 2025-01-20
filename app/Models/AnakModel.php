<?php

namespace App\Models;

use CodeIgniter\Model;

class AnakModel extends Model
{
    protected $table      = 'tbl_anak';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user',
        'nama_anak',
        'nik',
        'tgl_lahir',
        'anak_ke',
        'nomor_akta',
        'tgl_akta',
        'attachment'
    ];

    protected $useTimestamps = false;
}
