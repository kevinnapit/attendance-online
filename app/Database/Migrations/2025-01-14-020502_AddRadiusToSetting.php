<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRadiusToSetting extends Migration
{
    public function up()
    {
        // Menambahkan kolom 'radius' ke tabel 'setting'
        $this->forge->addColumn('setting', [
            'radius' => [
                'type' => 'VARCHAR',      // Tipe data untuk radius
                'constraint' => 50,     // Nilai default (opsional)
                'after' => 'lokasi_kantor' // Posisi setelah kolom tertentu (opsional)
            ],
        ]);
    }

    public function down()
    {
        // Menghapus kolom 'radius' dari tabel 'setting'
        $this->forge->dropColumn('setting', 'radius');
    }
}
