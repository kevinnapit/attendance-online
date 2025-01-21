<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAnak extends Migration
{
    public function up()
    {
        // Membuat tabel tbl_anak
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'id_user'       => [
                'type'           => 'INT',
                'unsigned'      => true
            ],
            'nama_anak'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'nik'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'tgl_lahir'     => [
                'type'           => 'DATE',
            ],
            'anak_ke'       => [
                'type'           => 'INT',
                'unsigned'      => true,
            ],
            'nomor_akta'    => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'tgl_akta'      => [
                'type'           => 'DATE',
            ],
            'attachment'    => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ]
        ]);

        // Menambahkan key
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');

        // Membuat tabel
        $this->forge->createTable('tbl_anak');
    }

    public function down()
    {
        // Menghapus tabel tbl_anak
        $this->forge->dropTable('tbl_anak');
    }
}
