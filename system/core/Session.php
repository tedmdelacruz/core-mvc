<?php
/**
 *
 * Session
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core;

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
    public function setData($identifier, $value)
    {
        $_SESSION[$identifier] = $value;
    }

    /**
     * Stops the current session
     * @return void
     */
    public function stop()
    {
        session_stop();
    }

    /**
     * Clears all Session data
     * @return void
     */
    public function clear()
    {
        session_unset();
    }

    /**
     * Retrieves a Session data
     * @param  string $identifier
     * @return mixed
     */
    public function getData($identifier)
    {
        if(self::isRegistered($identifier))
        {
            return $_SESSION[$identifier];
        }

        return false;
    }

    /**
     * Determines if a Session is set.
     * Supposedly named isSet but isSet is a reserved keyword
     * @param  string  $identifier
     * @return boolean
     */
    public function isRegistered($identifier)
    {
        if( isset($_SESSION[$identifier]) )
        {
            return true;
        }

        return false;
    }

    /**
     * Sets a Session flash data
     * @param string $identifier
     * @param string $message
     */
    public function setFlashData($identifier, $message)
    {
        $_SESSION['FLASH_DATA'][$identifier] = $message;
    }

    /**
     * Gets a Session flash data
     * Removes the Session data on retrieval
     * @param  string $identifier
     * @return string mixed
     */
    public function getFlashData($identifier)
    {
        if( isset($_SESSION['FLASH_DATA'][$identifier]) )
        {
            return $_SESSION['FLASH_DATA'][$identifier];
        }

        return NULL;
    }

    /**
     * Clears Session flash data
     * @return void
     */
    public function clearFlashData()
    {
        $_SESSION['FLASH_DATA'] = array();
    }
}