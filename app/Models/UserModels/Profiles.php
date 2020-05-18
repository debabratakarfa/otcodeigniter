<?php

/**
 * UserModels for Profiles
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Models\UserModels;

use CodeIgniter\Model;

/**
 * Class Profiles
 *
 * @package App\Models\UserModels
 */
class Profiles extends Model
{

	var $table = 'users';

	/**
	 * Profiles constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$db = \Config\Database::connect();
	}

	/**
	 * Get User data.
	 *
	 * @param  $data User data.
	 * @return array|mixed User data.
	 */
	public function get_user($data)
	{
		$query = $this->db->table($this->table)->getWhere($data);
		return $query->getResult();
	}

	/**
	 * Get all users.
	 *
	 * @return array Users data.
	 */
	public function get_users()
	{
		$query = $this->db->table($this->table)->get();
		return $query->getResultArray();
	}
}
