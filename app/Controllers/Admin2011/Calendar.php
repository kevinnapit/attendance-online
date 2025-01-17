<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\AdminModel;
use App\Models\ModelSetting;
use Carbon\Carbon;


class Calendar extends BaseController
{
    public function index()
    {
        return view('admin/calendar/index');
    }
}
