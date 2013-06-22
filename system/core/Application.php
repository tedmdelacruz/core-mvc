<?php namespace Core;

/**
 *
 * Core MVC Application
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 *
 * TODO: Form Validation
 *
 */

// The Core app is also an IoC container, similar to Laravel
class Application extends IoC
{
    /**
     * Start the Core
     */
    function start() {

        try
        {
            // Retrieve the current controller and method
            $controller = $this->router->getController();
            $method = $this->router->getMethod();

            // Connect to the database if is set
            if( is_object($this->db) )
            {
                $this->db->connect();
            }

            // Try instantiating the controller and calling the method
            if( ! class_exists($controller) OR ! method_exists($controller, $method)) {
                throw new Exceptions\CoreException("Page not found", 404);
            }

            $app_controller = new $controller();
            $app_controller->$method();
        }
        catch(\Exception $e)
        {
            $error['code'] = $e->getCode();
            $error['message'] = $e->getMessage();

            HTTP::status_code($e->getCode());

            View::render('error', $error);
        }
    }
}