<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'is_read' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',

            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);

        // Add foreign key user_id to admin table
        $this->forge->addForeignKey('user_id', 'tb_admin', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        // Drop the table if exists
        $this->forge->dropTable('notifications', true);
    }
}
