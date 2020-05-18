<?php
/**
 * UserModels for Login
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Models\UserModels;

use CodeIgniter\Model;

class Login extends Model {

	var $table = 'users';

    /**
     * Login constructor.
     */
	public function __construct()
	{
		parent::__construct();

		$db = \Config\Database::connect();
	}

    /**
     *
     * @param $data
     * @return array|mixed
     */
	public function get_user($data)
	{
		$query = $this->db->table($this->table)->getWhere($data);
		return $query->getResult();
	}
}
