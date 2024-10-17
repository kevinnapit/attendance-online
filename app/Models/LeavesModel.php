<?php

namespace App\Models;

use CodeIgniter\Model;

class LeavesModel extends Model
{
    protected $table            = 'leaves';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id','type','start_date','reason','end_date','status'
    ];
}
