<?php
/**
 * User model
 */
class User extends BaseModel
{

    /**
     * Returns a Validator instance for form validation
     * @return Validator
     */
    public static function validator()
    {
        $rules = array(
            'username' => array(
                'label' => 'Username',
                'rules' =>'required'
            ),
            'password' => array(
                'label' => 'Password',
                'rules' =>'required'
            ),
            'password_confirm' => array(
                'label' => 'Confirmation password',
                'rules' => 'required|matches[password]'
            )
        );

        return Validator::create($rules);
    }

    /**
     * Get all users
     * @return array array of user records
     */
    public static function get()
    {
        return DB::get('users');
    }

    /**
     * Get one user by ID
     * @param  int $id
     * @return User
     */
    public static function getById($id)
    {
        DB::from('users');
        DB::where('id', $id);

        return DB::getOne();
    }

    /**
     * Get one user by username
     * @param  string $username
     * @return User
     */
    public static function getByUsername($username)
    {
        DB::from('users');
        DB::where('username', $username);

        return DB::getOne();
    }

    /**
     * Registers a user
     * @return array User record for login
     */
    public static function register($username, $password)
    {
        $user['username'] = $username;
        $user['password'] = Hash::generate($password);

        DB::insert('users', $user);

        $id = DB::getLastInsertId();

        return self::getById($id);
    }

    /**
     * Attempts to login the user
     * @param  string $username
     * @param  string $password
     * @return boolean
     */
    public static function login($username, $password)
    {
        DB::from('users');
        DB::where('username', $username);
        $user = DB::getOne();

        if(is_object($user))
        {
            return TRUE;
        }

        return FALSE;
    }

    public static function test()
    {
        DB::test();
    }
}