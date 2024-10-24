<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\AdminModel;
use App\Models\ModelSetting;
use App\Models\LeavesModel;
use CodeIgniter\API\ResponseTrait;
use Pusher\Pusher;
use App\Models\NotifikasiModel;
use GuzzleHttp\Client;

class Notifikasi extends BaseController
{
    var $pusher, $model;
    public function __construct()
    {
        // // Konfigurasi Pusher
        // $options = array(
        //     'cluster' => 'ap1',
        //     'useTLS' => true,
        // );
        // $httpClient = new Client([
        //     'verify' => false,
        // ]);
        // $this->pusher = new Pusher(
        //     'YOUR_APP_KEY',      // Ganti dengan Pusher App Key
        //     'YOUR_APP_SECRET',   // Ganti dengan Pusher App Secret
        //     'YOUR_APP_ID',       // Ganti dengan Pusher App ID
        //     $options,
        //     $httpClient
        // );
        $this->model = new NotifikasiModel();
    }
    public function index()
    {

        $data['notifications'] = $this->model->where('is_read', 0)->findAll();
        return view('admin/notifikasi/vnotif', $data);
    }
    public function markAsRead()
    {
        $this->model->where('is_read', 0)->set(['is_read' => 1])->update();
    }

    public function sendNotification($message, $id_user)
    {
        $notificationModel = new NotifikasiModel();

        // Simpan notifikasi ke database
        $notificationModel->insert([
            'message' => $message,
            'user_id' => $id_user,
            'is_read' => 0
        ]);

        // Kirim event Pusher
        $data['message'] = $message;
        $data['user_id'] = $id_user;

        $this->pusher->trigger('notification-channel', 'new-notification', $data);
    }
    public function getNotifications()
    {
        $notificationModel = new NotifikasiModel();

        // Fetch unread notifications with username
        $notifications = $notificationModel->getUnreadNotificationsWithUser();

        // Return notifications as JSON
        return $this->response->setJSON($notifications);
    }
}
