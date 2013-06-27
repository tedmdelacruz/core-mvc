<?php namespace Core;
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
 *  TODO: Refactor parsing of URI to controller/method/parameters
 */
class Router
{

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

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Initialize the Router
     * @param Config $config Config instance for getting default controller/method
     */
    public function __construct(Config $config)
    {
        $controller = $config->get('config', 'default_controller');
        $method = $config->get('config', 'default_method');

        $uri = $_SERVER['REQUEST_URI'];
        print_r($_SERVER); die();
        print_r(parse_url(baseUrl(), PHP_URL_PATH)); die();;
        exit;

        $baseUrl = \baseUrl();

        exit(\stripProtocol($baseUrl));

        $this->method = $method;

        // Retrieve the controller::method based on the URI
        try
        {
            $segments = explode('/', trim($uri, '/'));

            switch(sizeof($segments))
            {
                case 1: {
                    list($host) = $segments;
                    break;
                }
                case 2: {
                    list($host, $controller) = $segments;
                    break;
                }
                case 3: {
                    list($host, $controller, $this->method) = $segments;
                    break;
                }
                case 4: {
                    list($host, $controller, $this->method, $parameters) = $segments;
                    break;
                }
                default: throw new \Exception("Invalid parameters");
            }

            $this->controller = ucfirst($controller) . "Controller";
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}