<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLeavesTable extends Migration
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
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['cuti', 'dinas_luar'],
                'null'       => false,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                
            ],
            'updated_at' => [
                'type' => 'DATETIME',
               
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);

        // Add foreign key user_id to admin table
        $this->forge->addForeignKey('user_id', 'tb_admin', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('leaves');
    }

    public function down()
    {
        // Drop the table if exists
        $this->forge->dropTable('leaves', true);
    }
}
