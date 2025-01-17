<?php

namespace App\Controllers;

class Blink extends BaseController
{
    public function checkBlink()
    {
        return view('blink_view');
    }
    public function attendanceSuccess()
    {

        return view('attsuccess');
    }
}
