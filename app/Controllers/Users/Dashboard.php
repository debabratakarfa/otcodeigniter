<?php

/**
 * Class Dashboard
 *
 * @package App\Controllers\Users
 *
 * @author  Debabrata Karfa <im@deb.im>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserModels\Login;
use App\Models\UserModels\Profiles;

/**
 * Class Dashboard
 *
 * @package App\Controllers\Users
 */
class Dashboard extends BaseController
{
	/**
	 * Using Session
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Set baseUrl
	 *
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * Dashboard constructor.
	 */
	public function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->session    = \Config\Services::session();
		$this->parser     = \Config\Services::parser();
		$this->session->start();
		$this->loginModel   = new Login();
		$this->profileModel = new Profiles();
		$this->baseUrl      = base_url();
	}

	/**
	 * Index Method.
	 *
	 * @return void
	 */
	public function index()
	{
		$sessId = $this->session->get('uid');

		if (! empty($sessId))
		{
			$userId['id']               = $sessId;
			$profileData                = $this->profileModel->get_user($userId);
			$userData                   = get_object_vars ($profileData[0]);
			$userData['title']          = 'User Dashboard';
			$listOfProfiles['profiles'] = $this->profileModel->get_users();

			echo view('templates/header', $userData);
			echo view('users/account', $userData);
			echo $this->parser->setData($listOfProfiles)->render('users/profiles');
			echo view('templates/footer', $userData);
		}
		else
		{
			$this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Session Expired !</div>');
			//load the login page
			$data['title'] = 'Login';

			echo view('templates/header', $data);
			echo view('users/login');
			echo view('templates/footer', $data);
		}
	}
}
