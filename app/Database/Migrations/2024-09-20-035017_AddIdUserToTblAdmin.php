<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdUserToTblAdmin extends Migration
{
    public function up()
    {
        // Tambahkan kolom id_user ke tabel tbl_admin
        $this->forge->addColumn('tb_admin', [
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'id' // Ubah column_name dengan nama kolom sebelum id_user
            ],
        ]);
    }

    public function down()
    {
        // Menghapus kolom id_user jika rollback
        $this->forge->dropColumn('tb_admin', 'id_user');
    }
}
