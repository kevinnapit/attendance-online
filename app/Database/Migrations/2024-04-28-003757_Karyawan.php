<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_presensi' => [
                'type' => 'INT',
                'constraint' => true,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_karyawan' => [
                'type' => 'INT',
                'constraint' => true,
                'unsigned' => true,
            ],
            'tgl_presensi' => [
                'type' => 'DATE',
            ],
            'jam_in' => [
                'type' => 'DATE'
            ],
            'jam_out' => [
                'type' => 'DATE'
            ],
            'lokasi_in' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'lokasi_out' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'foto_in' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'foto_out' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ]

        ]);
        $this->forge->addPrimaryKey('id_presensi');
        $this->forge->createTable('tbl_presensi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_presensi');
    }
}
