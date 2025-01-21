<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\ModelSetting;
use App\Models\UserModel;
use Carbon\Carbon;


class Profile extends BaseController
{
    public function index()
    {
        return view('front/profile/index');
    }
}
