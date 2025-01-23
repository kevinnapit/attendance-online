<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblPangkat extends Migration
{
    public function up()
    {
        // Membuat tabel tbl_pangkat
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'jenis_kp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tmt' => [
                'type' => 'DATE',
            ],
            'golongan' => [
                'type'       => 'ENUM',
                'constraint' => ['IA', 'IB', 'IC', 'ID', 'IIA', 'IIB', 'IIC', 'IID', 'IIIA', 'IIIB', 'IIIC', 'IVA', 'IVB', 'IVC', 'IVD', 'IVE'],
                'default'    => 'IA', // Default value
            ],
            'mkg_thn' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'mkg_bln' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'angka_kredit' => [
                'type'       => 'FLOAT',
                'constraint' => '5,2',
            ],
            'nomor_np_bkn' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_np_bkn' => [
                'type' => 'DATE',
            ],
            'nomor_sk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_sk' => [
                'type' => 'DATE',
            ],
            'attachments' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);


        // Menambahkan primary key dan index
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user', 'tb_users', 'id', 'CASCADE', 'CASCADE');

        // Membuat tabel
        $this->forge->createTable('tbl_pangkat');
    }

    public function down()
    {
        // Menghapus tabel
        $this->forge->dropTable('tbl_pangkat');
    }
}
