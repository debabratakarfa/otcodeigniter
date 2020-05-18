<?php

/**
 * Class Logout.
 * @package App\Controllers\Users
 *
 * @author Debabrata Karfa <im@deb.im>
 */

namespace App\Controllers\Users;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    /**
     * @var \CodeIgniter\Validation\Validation
     */
    protected $validation;

    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * Logout constructor.
     */
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->session->start();
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

        if(empty($sess_id))
        {
            $this->session->setFlashdata('error-msg', 'You are not Login user!');
            return redirect()->to($this->baseUrl . '/users/login');
        }

        $session_items = array('uname', 'uid');
        $this->session->remove($session_items);
        $this->session->setFlashdata('msg', 'Logout Sucessfully !');

        $data['title'] = 'Logout';
        echo view('templates/header', $data);
        echo view('users/login');
        echo view('templates/footer', $data);
    }
}
