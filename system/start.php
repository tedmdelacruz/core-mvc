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

    $app->config = function(){
        return new Config();
    };

    $app->router = function($app){
        $controller = $app->config->get('config', 'default_controller');
        $method = $app->config->get('config', 'default_method');

        return new Router($controller, $method);
    };

    $app->db = function($app){
        if($app->config->isDefined('database'))
        {
            return new DB($app->config->get('database'));
        }

        return null;
    };

    $app->auth = function($app){
        if($app->config->isDefined('database'))
        {
            return new Auth($app->config->get('auth', 'users_table'),
                $app->config->get('auth', 'users_table'));
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

    \Facade::setAppInstance($app);

    $app->start();
}
catch(\Exception $e)
{
    $error['code'] = $e->getCode();
    $error['message'] = $e->getMessage();

    HTTP::status_code($e->getCode());

    View::render('error', $error);

    exit();
}