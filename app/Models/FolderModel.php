<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table      = 'folder';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user',
        'kategori',
        'attachment'
    ];

    // Optional: Enable timestamps if you have 'created_at' and 'updated_at' columns
    protected $useTimestamps = false;
}
