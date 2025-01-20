<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblKeluarga extends Migration
{
    public function up()
    {
        // Tabel tbl_keluarga
        $this->forge->addField([
            'id'                    => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_user'               => ['type' => 'INT', 'unsigned' => true],
            'nama_pasangan'         => ['type' => 'VARCHAR', 'constraint' => '100'],
            'nik_pasangan'          => ['type' => 'VARCHAR', 'constraint' => '20'],
            'status_hidup_pasangan' => ['type' => 'ENUM', 'constraint' => "'Hidup', 'Meninggal', 'Cerai Hidup', 'Cerai Meninggal'", 'default' => 'Hidup'],
            'tgl_lahir_pasangan'    => ['type' => 'DATE'],
            'tgl_kawin'             => ['type' => 'DATE'],
            'nama_mertua_lk'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'nik_mertua_lk'         => ['type' => 'VARCHAR', 'constraint' => '20'],
            'tgl_mertua_lk'         => ['type' => 'DATE'],
            'status_hidup_mertua_lk' => ['type' => 'ENUM', 'constraint' => "'Hidup', 'Meninggal'", 'default' => 'Hidup'],
            'nama_mertua_pr'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'nik_mertua_pr'         => ['type' => 'VARCHAR', 'constraint' => '20'],
            'tgl_mertua_pr'         => ['type' => 'DATE'],
            'status_hidup_mertua_pr' => ['type' => 'ENUM', 'constraint' => "'Hidup', 'Meninggal'", 'default' => 'Hidup'],
            'no_akta_kawin'         => ['type' => 'VARCHAR', 'constraint' => '50'],
            'attachment'            => ['type' => 'VARCHAR', 'constraint' => '255'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_keluarga');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_keluarga');
    }
}
