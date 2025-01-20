<?php

namespace App\Models;

use CodeIgniter\Model;

class MutasiModel extends Model
{
    // Nama tabel yang digunakan
    protected $table            = 'tbl_mutasi';
    // Kolom primary key
    protected $primaryKey       = 'id';
    // Kolom yang boleh diinsert
    protected $allowedFields    = [
        'id_user',
        'tmt',
        'nomor_sk',
        'tanggal_sk',
        'jabatan',
        'eselon',
        'unit_kerja'
    ];
    // Menggunakan auto increment
    protected $useAutoIncrement = true;

    // Mengatur tipe data untuk kolom
    protected $returnType       = 'array';  // Atau 'object', tergantung kebutuhan Anda
    protected $useSoftDeletes   = false;    // Jika Anda ingin menggunakan soft delete
    protected $useTimestamps    = false;
    // Pesan error validasi
}
