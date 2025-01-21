<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFolderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'     => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'kategori'    => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'attachment'  => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true, // Karena bisa kosong jika tidak ada file
            ],
        ]);
        $this->forge->addKey('id', true);  // Menjadikan 'id' sebagai primary key
        $this->forge->addForeignKey('id_user', 'tbl_admin', 'id', 'CASCADE', 'CASCADE'); // Menambahkan foreign key ke tabel 'tbl_admin'
        $this->forge->createTable('folder');
    }

    public function down()
    {
        $this->forge->dropTable('folder');
    }
}
