<?php

/**
 * Class Login
 * @package App\Controllers\Users
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserModels\Login as UserModelsLogin;

class Login extends BaseController
{
    /**
     * @var \CodeIgniter\Validation\Validation
     */
    protected $validation;

    /**
     * @var UserModelsLogin
     */
    protected $LoginModel;

    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @var string
     */
    protected $baseUrl;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->LoginModel = new UserModelsLogin();
        $this->baseUrl = base_url();
    }

    /**
     * @var string
     */
    var $id = "";

    /**
     * @return string
     */
    public function index()
    {
        $sess_id = $this->session->get('uid');

        if(!empty($sess_id))
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
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function auth_user()
    {
        $data['email_address'] = $this->request->getPost("email_address");
        $data['user_password'] = md5($this->request->getPost("user_password"));

        $this->validation->setRules([
            'email_address' => [
                'label'  => 'Username',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'All accounts must have {field} provided'
                ]
            ],
            'user_password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'min_length' => 'Your {field} is too short. You want to get hacked?'
                ]
            ]
        ]);
        // form validation
        if ($this->validation->run($data) == FALSE) {
            // validation fail
            $this->session->setFlashdata('errors', '<div class="alert alert-danger text-center">'.$this->validation->listErrors().'</div>');
            return redirect()->to($this->baseUrl . '/users/login');
        } else {
            // check for user credentials

            $uresult = $this->LoginModel->get_user($data);

            if (count($uresult) > 0) {

                // set session
                $sess_data = array('login' => TRUE, 'uname' => $uresult[0]->first_name, 'uid' => $uresult[0]->id);

                $this->session->set($sess_data);

                return redirect()->to($this->baseUrl . '/users/dashboard');
            } else {
                $this->session->setFlashdata('error-msg', 'Wrong Email-ID or Password!');
                return redirect()->to($this->baseUrl . '/users/login');
            }
        }
    }

}

