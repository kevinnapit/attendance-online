<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'file';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_user', 'id_kategori', 'attachments'];
    protected $returnType = 'array';  // Mendefinisikan tipe data yang dikembalikan oleh model
    protected $useTimestamps = false; // Tidak menggunakan timestamp otomatis

    // Mendapatkan file berdasarkan kategori 0 untuk user tertentu
    public function getFilesByCategoryZero($userId)
    {
        return $this->where('id_user', $userId)
            ->where('id_kategori', 0)
            ->findAll();
    }
}
