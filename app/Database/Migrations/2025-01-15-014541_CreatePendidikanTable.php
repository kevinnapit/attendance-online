<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendidikanTable extends Migration
{
    public function up()
    {
        // Membuat tabel tbl_pendidikan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jenjang' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'institusi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nomor_ijazah' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'lulus' => [
                'type' => 'DATE',
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Create table
        $this->forge->createTable('tbl_pendidikan');
    }

    public function down()
    {
        // Drop table if it exists
        $this->forge->dropTable('tbl_pendidikan');
    }
}
