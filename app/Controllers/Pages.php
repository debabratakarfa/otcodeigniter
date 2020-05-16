<?php
/**
 * Class pages
 * @package App\Controllers
 */
namespace App\Controllers;


class Pages extends BaseController
{
    public function index()
    {
        echo 'Welcome to CodeIgniter, you are running on ' . \CodeIgniter\CodeIgniter::CI_VERSION;
    }

    /**
     * @param string $page
     */
    public function view($page = 'home')
    {
        if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);
    }

}
