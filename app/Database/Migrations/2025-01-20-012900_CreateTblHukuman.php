<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblHukuman extends Migration
{
    public function up()
    {
        // Membuat tabel tbl_hukuman
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
            'jenis_hukuman' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
            ],
        ]);

        // Menambahkan primary key dan foreign key
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user', 'tb_admin', 'id', 'CASCADE', 'CASCADE');

        // Membuat tabel
        $this->forge->createTable('tbl_hukuman');
    }

    public function down()
    {
        // Menghapus tabel
        $this->forge->dropTable('tbl_hukuman');
    }
}
