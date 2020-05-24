<?php

/**
 * Class Login
 *
 * @package App\Controllers\Users
 *
 * @author  Debabrata Karfa <im@deb.im>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserModels\Login as UserModelsLogin;

/**
 * Class Login
 *
 * @package App\Controllers\Users
 */
class Login extends BaseController
{
	/**
	 * Validation.
	 *
	 * @var \CodeIgniter\Validation\Validation
	 */
	protected $validation;

	/**
	 * Login Model.
	 *
	 * @var UserModelsLogin
	 */
	protected $loginModel;

	/**
	 * Session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Log Error Handler.
	 *
	 * @var string[] Error Data.
	 */
	protected $errorContext;

	/**
	 * Baseurl.
	 *
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * Login constructor.
	 */
	public function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->session    = \Config\Services::session();
		$this->session->start();
		$this->loginModel = new UserModelsLogin();
		$this->baseUrl    = base_url();
	}

	/**
	 * ID.
	 *
	 * @var string
	 */
	var $id = '';

	/**
	 * Index method.
	 *
	 * @return string
	 */
	public function index()
	{
		$sessId = $this->session->get('uid');

		if (! empty($sessId))
		{
			$this->session->setFlashdata('msg', 'Welcome Back !');
			return redirect()->to($this->baseUrl . '/users/dashboard');
		}

		$data['title'] = 'Login';
		echo view('templates/header', $data);
		echo view('users/login');
		echo view('templates/footer', $data);
	}

	/**
	 * Auth User Method.
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse|string
	 */
	public function auth_user()
	{
		$data['email_address'] = $this->request->getPost('email_address');
		$data['user_password'] = md5($this->request->getPost('user_password'));

		$this->errorContext['pre']   = '[LOGIN ERROR]';
		$this->errorContext['email'] = $data['email_address'];

		$this->validation->setRules([
			'email_address' => [
				'label'  => 'Username',
				'rules'  => 'required|valid_email',
				'errors' => [
					'required' => 'All accounts must have {field} provided',
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
		// form validation
		if ($this->validation->run($data) === false)
		{
			/**
			 * Validation fail
			 * Logging it and redirect to Login page.
			 */
			log_message(4, '{pre} Validation Errors', $this->errorContext);
			$this->session->setFlashdata('errors', '<div class="alert alert-danger text-center">' . $this->validation->listErrors() . '</div>');
			return redirect()->to($this->baseUrl . '/users/login');
		}
		else
		{
			$secret         = getenv('GOOOGLE_CAPTCHA_SECRET_KEY');
			$response       = $this->request->getPost('g-recaptcha-response');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response);
			$responseData   = json_decode($verifyResponse);
			if (! $responseData->success)
			{
				/**
				 * Checking if reCAPTHCHA validation fail or not.
				 * Logging it and redirect to Login page.
				 */
				log_message(4, '{pre} reCAPTCHA input is not valid {email} at Line no {line}', $this->errorContext);
				$this->session->setFlashdata('error-msg', 'reCAPTCHA input is not valid, please check.');
				return redirect()->to($this->baseUrl . '/users/login');
			}

			// check for user credentials
			$uresult = $this->loginModel->get_user($data);

			if (count($uresult) > 0)
			{
				// set session
				$sessData = [
					'login' => true,
					'uname' => $uresult[0]->first_name,
					'uid'   => $uresult[0]->id,
				];

				$this->session->set($sessData);

				$this->errorContext['pre'] = '[LOGIN SUCCESS]';
				$this->errorContext['id']  = $sessData['uid'];
				/**
				 * Login Success
				 * Logging Used ID and redirect to dashboard.
				 */
				log_message(4, '{pre} User {id} Login.', $this->errorContext);

				return redirect()->to($this->baseUrl . '/users/dashboard');
			}
			else
			{
				/**
				 * Login fail,
				 * Logging it and redirect to Login page.
				 */
				log_message(4, '{pre} Login failed for {email}', $this->errorContext);

				$this->session->setFlashdata('error-msg', 'Wrong Email-ID or Password!');
				return redirect()->to($this->baseUrl . '/users/login');
			}
		}
	}

}
