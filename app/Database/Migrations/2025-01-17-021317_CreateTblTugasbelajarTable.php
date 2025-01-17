<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblTugasbelajarTable extends Migration
{
    public function up()
    {
        // Create the table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'jenjang' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'institusi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_peningkatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nomor_sk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_sk' => [
                'type' => 'DATE',
            ],
        ]);

        // Primary key
        $this->forge->addPrimaryKey('id');

        // Foreign key (id_user)
        $this->forge->addForeignKey('id_user', 'tb_admin', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('tbl_tugasbelajar');
    }

    public function down()
    {
        // Drop the table if we roll back the migration
        $this->forge->dropTable('tbl_tugasbelajar');
    }
}
