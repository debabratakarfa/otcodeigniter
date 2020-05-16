<?php
namespace App\Controllers;

/**
 * Class Home
 * @package App\Controllers
 */
class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function welcome()
    {
        echo 'Welcome to CodeIgniter, you are running on ' . \CodeIgniter\CodeIgniter::CI_VERSION;
    }

}
