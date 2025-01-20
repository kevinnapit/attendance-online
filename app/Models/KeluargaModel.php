<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table = 'tbl_keluarga';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'nama_pasangan',
        'nik_pasangan',
        'status_hidup_pasangan',
        'tgl_lahir_pasangan',
        'tgl_kawin',
        'nama_mertua_lk',
        'nik_mertua_lk',
        'tgl_mertua_lk',
        'status_hidup_mertua_lk',
        'nama_mertua_pr',
        'nik_mertua_pr',
        'tgl_mertua_pr',
        'status_hidup_mertua_pr',
        'no_akta_kawin',
        'attachment'
    ];
    protected $useTimestamps = true;
}
