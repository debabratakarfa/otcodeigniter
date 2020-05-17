<?php

/**
 * Class Dashboard
 * @package App\Controllers\Users
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserModels\Login;
use App\Models\UserModels\Profiles;

class Dashboard extends BaseController
{
    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * Dashboard constructor.
     */
    public function __construct()
    {
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->LoginModel = new Login();
        $this->ProfileModel = new Profiles();
        $this->baseUrl = base_url();
    }

    /**
     * @return string
     */
    public function index()
    {
        $sess_id = $this->session->get('uid');

        if(!empty($sess_id))
        {
            $userId['id'] = $sess_id;
            $profileData = $this->ProfileModel->get_user($userId);
            $userData = get_object_vars ($profileData[0]);
            $userData['title'] = 'User Dashboard';

            echo view('templates/header', $userData);
            echo view('users/account',$userData);
            echo view('templates/footer', $userData);
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Session Expired !</div>');
            //load the login page
            $data['title'] = 'Login';

            echo view('templates/header', $data);
            echo view('users/login');
            echo view('templates/footer', $data);

        }
    }
}
