<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table      = 'tbl_pendidikan';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_user', 'jenjang', 'pendidikan', 'institusi', 'nomor_ijazah', 'lulus'];

    // Tanggal lulus menggunakan format date
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime'; // Format tanggal yang digunakan

    // Menambahkan validasi (jika diperlukan)
    protected $validationRules = [
        'id_user' => 'required|integer',
        'jenjang' => 'required|max_length[100]',
        'pendidikan' => 'required|max_length[255]',
        'institusi' => 'required|max_length[255]',
        'nomor_ijazah' => 'required|max_length[50]',
        'lulus' => 'required|valid_date',
    ];
}
