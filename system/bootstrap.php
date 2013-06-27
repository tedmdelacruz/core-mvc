<?php namespace Core;
if ( ! defined('SYS_PATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Prepare the main Core components
|--------------------------------------------------------------------------
|
*/

// Wrap the whole app initialization in a global exception handler
try
{
    $app = new Application();

    \Facade::setAppInstance($app);

    $app->config = function($app){
        return new Config();
    };

    $app->router = function($app){
        return new Router($app->config);
    };

    $app->db = function($app){
        if($app->config->isDefined('database'))
        {
            return new DB($app->config);
        }

        return null;
    };

    $app->auth = function($app){
        if($app->config->isDefined('database'))
        {
            return new Auth($app->config);
        }

        return null;
    };

    $app->asset = function($app){
        return new Asset();
    };

    $app->session = function($app){
        return new Session();
    };

    $app->input = function($app){
        return new Input();
    };

    $app->hash = function($app){
        return new Hash();
    };

    // Set the application instance to the Facade so that it knows where to resolve static functions in the global namespace
    // to the Core namespace
    \Facade::setAppInstance($app);

    $app->start();
}
catch(\Exception $e)
{
    $error['code'] = $e->getCode();
    $error['message'] = $e->getMessage();

    HTTP::status_code($e->getCode());

    View::render('error', $error);

    exit;
}