<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function loginKaryawan( $username, $password)
    {
        return $this->db->table('karyawan')
       
        ->where([
            'username' => $username,
            'password' => $password
        ])->get()->getRowArray();
    }
}
