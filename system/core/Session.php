<?php namespace Core;
/**
 *
 * Session
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Session
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Sets a SESSION data
     * @param string $identifier Session identifier
     * @param mixed  $value      Session value
     */
    public static function set_data($identifier, $value)
    {
        $_SESSION[$identifier] = $value;
    }

    public static function stop()
    {
        session_stop();
    }

    public static function get_data($identifier)
    {
        if(self::is_set($identifier))
        {
            return $_SESSION[$identifier];
        }

        return false;
    }

    public static function is_set($identifier)
    {
        if(isset($_SESSION[$identifier]))
        {
            return true;
        }

        return false;
    }

}