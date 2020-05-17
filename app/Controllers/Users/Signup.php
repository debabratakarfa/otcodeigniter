<?php

/**
 * Class Signup
 * @package App\Controllers\Users
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;

class Signup extends BaseController
{
    /**
     * @var SignupModel
     */
    protected $SignupModel;

    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @var \CodeIgniter\Validation\Validation
     */
    protected $validation;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * Signup constructor.
     */
    public function __construct()
    {
        $this->SignupModel = new \App\Models\UserModels\Signup();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->baseUrl = base_url();
    }

    public function index()
    {
        $data['title'] = 'Sign Up'; // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('users/registration', $data);
        echo view('templates/footer', $data);
    }

    public function add_user()
    {
        $this->SignupModel = new \App\Models\UserModels\Signup();
        $data['email_address'] = $this->request->getPost('email_address');
        $data['first_name'] = $this->request->getPost('first_name');
        $data['last_name'] = $this->request->getPost('last_name');
        $data['user_password'] = md5($this->request->getPost('user_password'));

        $this->validation->setRules([
            'email_address' => [
                'label'  => 'Username',
                'rules'  => 'required|valid_email|is_unique[users.email_address]',
                'errors' => [
                    'required' => 'All accounts must have {field} provided'
                ]
            ],
            'first_name' => [
                'label'  => 'FirstName',
                'rules'  => 'required',
                'errors' => [
                    'min_length' => 'Your {field} is too short. You want to get hacked?'
                ]
            ],
            'last_name' => [
                'label'  => 'LastName',
                'rules'  => 'required',
                'errors' => [
                    'min_length' => 'Your {field} is needed.'
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
            //  validation_errors() or not work with view('errors/_errors_list', $this->validation->getErrors())
            $this->session->setFlashdata('msg', $this->validation->listErrors());
            return redirect()->to($this->baseUrl . '/users/signup');
        }
        else {
            $id = $this->SignupModel->add_user($data);
            if($id) {
                $this->session->setFlashdata('msg', 'Successfully Register, Login now!');
                return redirect()->to($this->baseUrl . '/users/login');
            }

        }


    }
}

