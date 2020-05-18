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
    /**
     * Table
     *
     * @var string
     */
	var $table = 'users';

    /**
     * Signup constructor.
     */
	public function __construct()
	{
		parent::__construct();

		$db = \Config\Database::connect();
	}

    /**
     * Create new account.
     *
     * @param $data
     * @return int
     */
	public function add_user($data)
	{
		$this->db->table($this->table)->insert($data);
		return $this->db->insertID();
	}
}
