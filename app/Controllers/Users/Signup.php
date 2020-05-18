<?php

/**
 * Class Signup
 *
 * @package App\Controllers\Users
 *
 * @author  Debabrata Karfa <im@deb.im>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;

/**
 * Class Signup
 *
 * @package App\Controllers\Users
 */
class Signup extends BaseController
{
	/**
	 * Signup Model.
	 *
	 * @var signupModel
	 */
	protected $signupModel;

	/**
	 * Session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Validation.
	 *
	 * @var \CodeIgniter\Validation\Validation
	 */
	protected $validation;

	/**
	 * Curl Client.
	 *
	 * @var \CodeIgniter\HTTP\CURLRequest
	 */
	protected $client;
	/**
	 * BaseURL.
	 *
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * Signup constructor.
	 */
	public function __construct()
	{
		$this->signupModel = new \App\Models\UserModels\Signup();
		$this->session     = \Config\Services::session();
		$this->validation  = \Config\Services::validation();
		$this->client      = \Config\Services::curlrequest();
		$this->baseUrl     = base_url();
	}

	/**
	 * Index Method.
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function index()
	{
		$sessId = $this->session->get('uid');

		if (! empty($sessId))
		{
			$this->session->setFlashdata('msg', 'Welcome Back!');
			return redirect()->to($this->baseUrl . '/users/dashboard');
		}

		$data['title'] = 'Sign Up';

		echo view('templates/header', $data);
		echo view('users/registration', $data);
		echo view('templates/footer', $data);
	}

	/**
	 * Add User Method.
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function add_user()
	{
		$this->signupModel     = new \App\Models\UserModels\Signup();
		$data['email_address'] = $this->request->getPost('email_address');
		$data['first_name']    = $this->request->getPost('first_name');
		$data['last_name']     = $this->request->getPost('last_name');
		$data['user_password'] = md5($this->request->getPost('user_password'));

		$this->validation->setRules([
			'email_address' => [
				'label'  => 'Username',
				'rules'  => 'required|valid_email|is_unique[users.email_address]',
				'errors' => [
					'required' => 'All accounts must have {field} provided',
				],
			],
			'first_name'    => [
				'label'  => 'FirstName',
				'rules'  => 'required',
				'errors' => [
					'min_length' => 'Your {field} is too short. You want to get hacked?',
				],
			],
			'last_name'     => [
				'label'  => 'LastName',
				'rules'  => 'required',
				'errors' => [
					'min_length' => 'Your {field} is needed.',
				],
			],
			'user_password' => [
				'label'  => 'Password',
				'rules'  => 'required|min_length[4]',
				'errors' => [
					'min_length' => 'Your {field} is too short. You want to get hacked?',
				],
			],
		]);

		$this->disposableEmailCheck($this->request->getPost('email_address'));

		if ($this->disposableEmailCheck($this->request->getPost('email_address')))
		{
			$this->session->setFlashdata('msg', 'Kindly use valid email, not a disposable email !');
			return redirect()->to($this->baseUrl . '/users/signup');
		}

		// form validation
		if ($this->validation->run($data) === false)
		{
			//  validation_errors() or not work with view('errors/_errors_list', $this->validation->getErrors())
			$this->session->setFlashdata('msg', $this->validation->listErrors());
			return redirect()->to($this->baseUrl . '/users/signup');
		}
		else
		{
			$secret         = getenv('GOOOGLE_CAPTCHA_SECRET_KEY');
			$response       = $this->request->getPost('g-recaptcha-response');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response);
			$responseData   = json_decode($verifyResponse);
			if (! $responseData->success)
			{
				$this->session->setFlashdata('msg', 'reCAPTCHA input is not valid.');
				return redirect()->to($this->baseUrl . '/users/signup');
			}

			$id = $this->signupModel->add_user($data);
			if ($id)
			{
				$this->session->setFlashdata('msg', 'Successfully Register, Login now!');
				return redirect()->to($this->baseUrl . '/users/login');
			}
		}
	}

	/**
	 * Check if it is a disposable Email or not.
	 *
	 * @param string $email Email Address.
	 *
	 * @return boolean  Return TRUE if it is a disposable Email.
	 */
	protected function disposableEmailCheck($email)
	{
		$verifyResponse = file_get_contents('https://open.kickbox.com/v1/disposable/' . $email);
		return json_decode($verifyResponse)->disposable;
	}
}
