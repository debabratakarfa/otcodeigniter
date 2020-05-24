<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'first_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => TRUE,
            ],
            'last_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => TRUE,
            ],
            'email_address'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'user_password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'created_at'       => [
                'type'           => 'DATETIME',
            ],
            'update_at'       => [
                'type'           => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->forge->dropTable('users');
	}
}
