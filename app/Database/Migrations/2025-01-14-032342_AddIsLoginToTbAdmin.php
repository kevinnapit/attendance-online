<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsLoginToTbAdmin extends Migration
{
    public function up()
    {
        // Menambahkan kolom 'isLogin' ke tabel 'tb_admin' dengan nilai default 0
        $this->forge->addColumn('tb_admin', [
            'isLogin' => [
                'type' => 'TINYINT',   // Tipe data untuk isLogin (0 atau 1)
                'constraint' => 1,     // TINYINT hanya membutuhkan 1 byte
                'default' => 0,        // Nilai default adalah 0
                'after' => 'id',       // Posisi kolom setelah kolom 'id' (opsional)
            ],
        ]);
    }

    public function down()
    {
        // Menghapus kolom 'isLogin' dari tabel 'tb_admin'
        $this->forge->dropColumn('tb_admin', 'isLogin');
    }
}
