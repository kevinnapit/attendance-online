<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'message',
        'is_read',
        'created_at'
    ];
    public function getUnreadNotificationsWithUser()
    {
        return $this->select('notifications.*, admin.username')
            ->join('admin', 'admin.id = notifications.id_user')
            ->where('notifications.is_read', 0)
            ->orderBy('notifications.created_at', 'DESC')
            ->findAll();
    }
}
