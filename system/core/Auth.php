<?php
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

namespace Core;

class Auth
{
    private $usersTable = '';
    private $userIdentifier = '';

    private $session;

    private $db;

    /**
     * Initialize the Auth
     * @param Config $config Config instance for getting users table and user identifier
     */
    public function __construct(Config $config, Session $session, DB $db)
    {
        $this->usersTable = $config->get('auth', 'users_table');
        $this->userIdentifier = $config->get('auth', 'user_identifier');
        $this->session = $session;
        $this->db = $db;
    }

    /**
     * Checks if user is logged in
     * @return boolean
     */
    public function isLoggedIn()
    {
        if($this->session->isRegistered($this->userIdentifier))
        {
            return true;
        }

        return false;
    }

    /**
     * Gets the user logged in
     * @return mixed Returns User object if logged in, else returns null
     */
    public function user()
    {
        if($this->isLoggedIn())
        {
            return $this->session->get_data($this->userIdentifier);
        }

        return null;
    }

    /**
     * Attempts to log in the user
     * @param  string $userIdentifier
     * @param  string $password
     * @return boolean
     */
    public function login($userIdentifier, $password)
    {
        $this->db->from($this->usersTable);
        $this->db->where($this->userIdentifier, $userIdentifier);
        $user = $this->db->getOne();

        if( ! is_object($user) )
        {
            $this->session->setData('username', $user->username);
            return TRUE;
        }

        return FALSE;
    }
}