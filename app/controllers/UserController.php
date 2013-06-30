<?php
/**
 * User Controller
 *
 * Example controller which demonstrates basic CRUD functionality
 *
 */
class UserController extends BaseController
{
    /**
     * Index
     * @return void
     */
    public function index()
    {
        $this->data['title'] .= " :: Users";
        $this->data['users'] = User::get('users');

        View::render('users', $this->data);
    }

    /**
     * Login
     * @return void
     */
    public function login()
    {
        $this->data['title'] .= " :: Login";

        $post = Input::post();

        if(! empty($post))
        {
            $username = $post['username'];
            $password = Hash::generate($post['password']);

            Auth::login($username, $password);
        }

        View::render('user/login', $this->data);
    }

    /**
     * Register
     * @return void
     */
    public function register()
    {
        $this->data['title']   .= " :: Register";

        $post = Input::post();

        if( ! empty($post) )
        {
            $v = User::validator($post);

            try
            {
                if( ! $v->valid())
                {
                    throw new \Exception($v->getErrors());
                }
                // Register the user and retrieve the record created
                $user = User::register($post['username'], $post['password']);

                // Attempt to login
                Auth::login($user->username, $user->password);

                Session::setFlashData('success', 'You have successfully registered and logged in.');

                Router::redirect('user');
            }
            catch(Exception $e)
            {
                $this->data['error'] = $v->getErrors();
            }
        }

        View::render('user/register', $this->data);
    }

    public function logout()
    {
        Auth::logout();

        Session::setFlashData('success', 'You have successfully logged out.');

        Router::redirect('user');
    }

}
