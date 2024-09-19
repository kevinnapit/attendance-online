<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'tb_admin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password','role', 'name','token', 'picture', 'created_at', 'updated_at'];

    function getData($param)
    {
        $data = $this->where('username', $param)->first();
        if (empty($data['id'])) $data = $this->where('email', $param)->first();
        return $data;
    }
}
