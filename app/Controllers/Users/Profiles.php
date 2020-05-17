<?php


namespace App\Controllers\Users;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModels\Profiles as ProfileModel;

class Profiles extends Controller
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
     * Profiles constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        parent::__construct($request, $response);
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->Profile_Model = new ProfileModel();
        $this->baseUrl = base_url();
        helper('url');
    }

    /**
     * @return string
     */
    public function index()
    {
        $sess_id = $this->session->get('uid');

        if (!empty($sess_id)) {
            $userId['id'] = $sess_id;
            $profileData = $this->Profile_Model->get_user($userId);
            $userData = get_object_vars($profileData[0]);
            echo view('dashboard/head/index');
            echo view('dashboard/nav/index', $userData);
            echo view('dashboard/profile', $userData);
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Session Expired !</div>');
            //load the login page
            return view('dashboard/signin.php');
        }
    }
}

