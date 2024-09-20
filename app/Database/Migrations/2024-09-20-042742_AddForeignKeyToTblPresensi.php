<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyToTblPresensi extends Migration
{
    public function up()
    {
        // Tambahkan kolom id_user di tbl_presensi
        $this->forge->addColumn('tbl_presensi', [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);

        // Tambahkan foreign key pada kolom id_user di tbl_presensi yang merujuk ke id_user di tbl_admin
        $this->forge->addForeignKey('id', 'tbl_admin', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Hapus foreign key dan kolom id_user jika rollback
        $this->forge->dropForeignKey('tbl_presensi', 'tbl_presensi_id_foreign');
        $this->forge->dropColumn('tbl_presensi', 'id');
    }
}
