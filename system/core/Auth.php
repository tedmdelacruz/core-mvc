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
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Gets the logged in user
     * @return mixed Returns User object if logged in, else returns null
     */
    public function user()
    {
        if($this->isLoggedIn())
        {
            return $this->session->getData($this->userIdentifier);
        }

        return NULL;
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

        if( is_object($user) )
        {
            $this->session->setData($this->userIdentifier, $user->{$this->userIdentifier});

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Logs out the user
     * @return void
     */
    public function logout()
    {
        $this->session->clear();
    }
}