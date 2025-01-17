<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DiskusiModel;
use CodeIgniter\Config\Config;

class Profil extends BaseController
{
    public function index()
    {
        return view('admin/user/profile');
    }
}
