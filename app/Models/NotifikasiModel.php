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
        return $this->select('notifications.*, tb_admin.username')
            ->join('tb_admin', 'tb_admin.id = notifications.user_id')
            ->where('notifications.is_read', 0)
            ->orderBy('notifications.created_at', 'DESC')
            ->findAll();
    }
    public function markNotificationsAsRead()
    {
        $notificationModel = new NotifikasiModel();

        // Tandai semua notifikasi sebagai dibaca
        $notificationModel->where('is_read', 0)->set('is_read', 1)->update();

        return $this->response->setJSON(['status' => 'success']);
    }
}
