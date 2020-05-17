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

    public function __construct() {
        parent::__construct();

        $db = \Config\Database::connect();
    }

    public function get_user($data)
    {
        $query = $this->db->table($this->table)->getWhere($data);
        return $query->getResult();
    }
}
