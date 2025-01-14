<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsernameToTblPresensi extends Migration
{
    public function up()
    {
        // Menambahkan kolom 'username' ke tabel 'tbl_presensi'
        $this->forge->addColumn('tbl_presensi', [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'after' => 'id', // Menentukan posisi kolom setelah kolom 'id' (opsional)
            ],
        ]);
    }

    public function down()
    {
        // Menghapus kolom 'username' dari tabel 'tbl_presensi'
        $this->forge->dropColumn('tbl_presensi', 'username');
    }
}
