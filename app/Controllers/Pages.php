<?php
/**
 * Class pages
 * @package App\Controllers
 */
namespace App\Controllers;


class Pages extends BaseController
{
    /**
     * Session.
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Pages constructor.
     */
    public function __construct()
    {
        $this->session     = \Config\Services::session();
    }

    /**
     * Index Method.
     */
    public function index()
    {
        echo 'Welcome to CodeIgniter, you are running on ' . \CodeIgniter\CodeIgniter::CI_VERSION;
    }

    /**
     * @param string $page
     */
    public function view($page = 'home')
    {
        log_message(7, 'HomePage visit.');

        if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $sessId = $this->session->get('uid');

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['id'] = $sessId;

        echo view('templates/header', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);
    }

}
