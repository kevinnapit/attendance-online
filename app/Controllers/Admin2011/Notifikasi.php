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

class CutiIzin extends BaseController
{
    public function getNotifications()
    {
        $notificationModel = new NotifikasiModel();

        // Fetch unread notifications with username
        $notifications = $notificationModel->getUnreadNotificationsWithUser();

        // Return notifications as JSON
        return $this->response->setJSON($notifications);
    }
}
