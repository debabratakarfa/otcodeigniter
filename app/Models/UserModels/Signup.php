<?php

/**
 * UserModels for Signup
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Models\UserModels;

use CodeIgniter\Model;

class Signup extends Model
{
	var $table = 'users';

	public function __construct()
	{
		parent::__construct();

		$db = \Config\Database::connect();
	}

	public function add_user($data)
	{
		$this->db->table($this->table)->insert($data);
		return $this->db->insertID();
	}
}
