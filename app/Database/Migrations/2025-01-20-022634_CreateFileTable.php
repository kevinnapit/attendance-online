<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFileTable extends Migration
{
    public function up()
    {
        // Membuat tabel 'file'
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'attachments' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        // Menentukan primary key
        $this->forge->addPrimaryKey('id');

        // Membuat tabel
        $this->forge->createTable('file');
    }

    public function down()
    {
        // Menghapus tabel 'file'
        $this->forge->dropTable('file');
    }
}
