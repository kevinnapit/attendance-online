<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetting extends Model
{
    public function datasetting()
    {
        return $this->db->table('setting')
            ->where('id_setting',1)->get()->getRowArray();
    }
    public function updatesetting($data)
    {
        $this->db->table('setting')
        ->where('id_setting',1)
        ->update($data);
    }
}
