<?php namespace Core;
/**
 *
 * Auth
 *
 * Manages all user authentication
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Auth
{
    private static $users_table = '';
    private static $user_identifier = '';

    public function __construct($users_table, $user_identifier)
    {
        self::$users_table = $users_table;
        self::$user_identifier = $user_identifier;
    }

    /**
     * Checks if user is logged in
     * @return boolean
     */
    public static function is_logged_in()
    {
        if(Session::is_set(self::$user_identifier))
        {
            return true;
        }

        return false;
    }

    /**
     * Gets the user logged in
     * @return mixed Returns User object if logged in, else returns null
     */
    public static function user()
    {
        if(self::is_logged_in())
        {
            return Session::get_data(self::$user_identifier);
        }

        return null;
    }

    /**
     * Attempts to log in the user
     * @param  string $user_identifier
     * @param  string $password
     * @return boolean
     */
    public static function login($user_identifier, $password)
    {
        DB::where('password', $password);
        DB::get(self::$users_table);
    }
}