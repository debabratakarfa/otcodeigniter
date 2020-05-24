<?php
/**
 * Users Migration.
 *
 * @package App\Database\Migrations
 *
 * @author  Debabrata Karfa <im@deb.im>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Class Users Migration.
 *
 * @package App\Database\Migrations
 */
class Users extends Migration
{
	/**
	 * Create Users table while `php sprak migrate` command run in CLI.
	 *
	 * @return void Create `users` table.
	 */
	public function up()
	{
		$this->forge->addField([
			'id'            => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'first_name'    => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => true,
			],
			'last_name'     => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => true,
			],
			'email_address' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
			],
			'user_password' => [
				'type'       => 'VARCHAR',
				'constraint' => 100,
			],
			'created_at'    => [
				'type' => 'DATETIME',
			],
			'update_at'     => [
				'type' => 'DATETIME',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	/**
	 * Drop users table while `php sprak migrate:rollback` command run in CLI.
	 *
	 * @return void Drop table.
	 */
	public function down()
	{
		$this->forge->dropTable('users');
	}
}
