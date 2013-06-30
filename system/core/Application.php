<?php
/**
 *
 * Core MVC Application
 *
 * The Application is also an IoC container, similar to Laravel
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 *
 */

namespace Core;

class Application extends IoC
{
    /**
     * Start the Core
     * @return void
     */
    function start() {

        // Connect to the database if is set
        if( is_object($this->db) )
        {
            $this->db->connect();
        }

        // Attempt to resolve the current route
        $this->router->resolve();
    }

    /**
     * Stops the Core
     * @return void
     */
    function stop()
    {
        $this->session->clearFlashData();
    }
}