<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatModel extends Model
{
    protected $table            = 'tbl_pangkat';  // Nama tabel
    protected $primaryKey       = 'id';           // Kolom primary key
    protected $useAutoIncrement = true;           // Menggunakan auto increment
    protected $allowedFields    = [
        'id_user',
        'jenis_kp',
        'tmt',
        'golongan',
        'mkg_thn',
        'mkg_bln',
        'angka_kredit',
        'nomor_np_bkn',
        'tanggal_np_bkn',
        'nomor_sk',
        'tanggal_sk',
        'attachments'
    ];

    // Jika ingin menambahkan validation rules
    protected $validationRules  = [];

    // Custom validation messages (optional)
    protected $validationMessages = [];

    // Jika ingin menambahkan pengecekan data unique
    protected $validationRulesUnique = [
        // 'field_name' => 'is_unique[tbl_pangkat.field_name]'
    ];

    // Jika ingin menambahkan before insert hooks (optional)
    protected $beforeInsert = ['sanitizeData'];

    // Sanitasi data sebelum dimasukkan ke dalam database
    protected function sanitizeData(array $data)
    {
        // Misalnya, menghilangkan spasi tambahan pada field string
        if (isset($data['data']['jenis_kp'])) {
            $data['data']['jenis_kp'] = trim($data['data']['jenis_kp']);
        }

        return $data;
    }
}
