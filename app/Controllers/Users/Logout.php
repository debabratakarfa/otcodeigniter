<?php

/**
 * Class Logout.
 *
 * @package App\Controllers\Users
 *
 * @author  Debabrata Karfa <im@deb.im>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;

/**
 * Class Logout
 *
 * @package App\Controllers\Users
 */
class Logout extends BaseController
{
	/**
	 * Validation.
	 *
	 * @var \CodeIgniter\Validation\Validation
	 */
	protected $validation;

	/**
	 * Session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * BaseUrl.
	 *
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * Logout constructor.
	 */
	public function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->session    = \Config\Services::session();
		$this->session->start();
		$this->baseUrl = base_url();
	}

	/**
	 * ID.
	 *
	 * @var string
	 */
	var $id = '';

	/**
	 * Index Method.
	 *
	 * @return string
	 */
	public function index()
	{
		$sessId = $this->session->get('uid');

		if (empty($sessId))
		{
			$this->session->setFlashdata('error-msg', 'You are not Login user!');
			return redirect()->to($this->baseUrl . '/users/login');
		}

		$sessionItems = [
			'uname',
			'uid',
		];
		$this->session->remove($sessionItems);
		$this->session->setFlashdata('msg', 'Logout Sucessfully !');

		$data['title'] = 'Logout';
		echo view('templates/header', $data);
		echo view('users/login');
		echo view('templates/footer', $data);
	}
}
