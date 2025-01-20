<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMutasi extends Migration
{
    public function up()
    {
        // Membuat tabel tbl_mutasi
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'tmt' => [
                'type' => 'DATE',
            ],
            'nomor_sk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_sk' => [
                'type' => 'DATE',
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'eselon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'unit_kerja' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        // Menambahkan primary key dan foreign key
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user', 'tb_admin', 'id', 'CASCADE', 'CASCADE');

        // Membuat tabel
        $this->forge->createTable('tbl_mutasi');
    }

    public function down()
    {
        // Menghapus tabel
        $this->forge->dropTable('tbl_mutasi');
    }
}
