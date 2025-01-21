<?php

namespace App\Models;

use CodeIgniter\Model;

class DisiplinModel extends Model
{
    protected $table            = 'tbl_hukuman'; // Nama tabel
    protected $primaryKey       = 'id'; // Primary key
    protected $allowedFields    = [
        'id_user',
        'jenis_hukuman',
        'tanggal_mulai',
        'tanggal_selesai'
    ]; // Kolom yang bisa di-insert

    // Mengatur format tanggal
    protected $useTimestamps    = false; // Tidak menggunakan created_at dan updated_at
    // Jika ingin menggunakan timestamps, Anda bisa menambahkan kolom `created_at` dan `updated_at` di migration, kemudian set `useTimestamps` ke true.
}
