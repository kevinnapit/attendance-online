<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    public function index()
    {
        return view('admin/user/v_user');
    }
}
