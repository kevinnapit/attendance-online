<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jabatan' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
            ]);
            $this->forge->addPrimaryKey('id_jabatan');
            $this->forge->createTable('tbl_jabatan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_jabatan');
    }
}
