<?php
/**
 *
 * Router
 * Manages all URI-related tasks
 * Accepts default controller and method for initialization
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 *
 */

namespace Core;

class Router
{
    /**
     * Core HTTP instance
     * @var Core\HTTP
     */
    private $http = NULL;

    /**
     * Current controller
     * @var string
     */
    private $controller;

    /**
     * Current method
     * @var string
     */
    private $method;

    /**
     * Current parameters
     * @var array
     */
    private $parameters;

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Initialize the Router
     * @param Core\Config $config
     */
    public function __construct(Config $config, HTTP $http)
    {
        $controller   = $config->get('config', 'default_controller');
        $method       = $config->get('config', 'default_method');
        $params       = array();

        $this->http   = $http;

        $uri          = $_SERVER['REQUEST_URI'];
        $baseUrl      = \baseURL();

        $uriParts     = explode('/', $uri);
        $baseUrlParts = explode('/', $baseUrl);
        $serverDir    = array_intersect($uriParts, $baseUrlParts);

        /*
         * Obtain the resource locator(controller, method, parameters)
         * by getting the array difference of the URI and server directory
         *
         * Example:         *
         *    $uriParts     = ['site_dir', 'public' 'controller', 'method', 'arg1', 'arg2']
         *    $baseUrlParts = ['http:', 'host' 'site_dir', 'public']
         *    $serverDir    = ['site_dir', 'public']
         *    $resource     = ['controller', 'method', 'arg1', 'arg2']
         *
         *  Function array_values() resets the indices to zero
         */
        $resource = array_values(array_diff_assoc($uriParts, $serverDir));

        // Retrieve the controller/method based on the resolved resource
        switch(sizeof($resource))
        {
            case 0: break;
            case 1: list($controller) = $resource; break;
            case 2: list($controller, $method) = $resource; break;
            default:
                $controller = $resource[0];
                $method = $resource[1];
        }

        // Prepare the controller based on Core conventions
        $this->controller = ucfirst($controller) . "Controller";
        $this->method = $method;

        /*
         * Get the parameters by obtaining the difference between ['controller', 'method']
         * and the resource array
         */
        $this->parameters = array_values(array_diff_assoc($resource, array($controller, $method)));
    }

    /**
     * Attempt to resolve the current resource
     * @return void
     */
    public function resolve()
    {
        $controller = $this->controller;
        $method     = $this->method;
        $parameters = $this->parameters;

        // Try instantiating the controller and calling the method
        if( ! class_exists($controller)
            OR ! method_exists($controller, $method)
        ) {
            throw new Exceptions\CoreException("Page not found", 404);
        }

        $app_controller = new $controller();

        switch (count($parameters))
        {
            case 0:
                return $app_controller->$method(); break;

            case 1:
                return $app_controller->$method($parameters[0]); break;

            case 2:
                return $app_controller->$method($parameters[0], $parameters[1]); break;

            case 3:
                return $app_controller->$method($parameters[0], $parameters[1], $parameters[2]); break;

            case 4:
                return $app_controller->$method($parameters[0], $parameters[1], $parameters[2], $parameters[3]); break;

            default:
                return call_user_func_array(array($app_controller, $method), $parameters); break;
        }
    }

    /**
     * Redirects using HTTP headers
     * @param  string $resource
     * @return void
     */
    public function redirect($resource)
    {
        $location = \baseURL($resource);

        $this->http->header("Location: {$location}");
    }
}
