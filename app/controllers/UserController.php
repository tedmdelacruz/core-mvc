<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/**
 * User Controller
 *
 * Example controller which demonstrates basic CRUD functionality
 *
 */
class UserController extends BaseController
{

    public function index()
    {
        $this->data['title'] .= " :: Users";
        $this->data['users'] = User::get('users');

        View::render('users', $this->data);
    }


    public function login()
    {
        $this->data['title'] .= " :: Login";

        $post = Input::post();

        if(! empty($post))
        {

            $username = $post['username'];
            // $password = Hash::generate($post['password']);
            $password = '';

            Auth::login($username, $password);

        }

        View::render('user/login', $this->data);

    }

}
