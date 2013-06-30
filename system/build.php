<?php namespace Core;
/*
|--------------------------------------------------------------------------
| Prepare Core dependencies
|--------------------------------------------------------------------------
|
*/

// Wrap the whole app initialization in a global exception handler
try
{
    $app = new Application();

    $app->config = function(){
        return new Config();
    };

    $app->http = function(){
        return new Http();
    };

    $app->router = function($app){
        return new Router($app->config, $app->http);
    };

    $app->db = function($app){
        if($app->config->isDefined('database'))
        {
            return new DB($app->config);
        }

        return null;
    };

    $app->session = function(){
        return new Session();
    };

    $app->auth = function($app){
        if($app->config->isDefined('database'))
        {
            return new Auth($app->config, $app->session, $app->db);
        }

        return null;
    };

    $app->view = function(){
        return new View();
    };

    $app->asset = function(){
        return new Asset();
    };

    $app->input = function(){
        return new Input();
    };

    $app->validator = function($app){
        return new Validator($app->input);
    };

    $app->passwordHash = function($app){
        return new \PasswordHash(8, FALSE);
    };

    $app->hash = function($app){
        return new Hash($app->passwordHash);
    };

    // Set the application instance to the Facade so that it knows where to
    // resolve static functions in the global namespace to the Core namespace
    \Facade::setAppInstance($app);

    // All systems go
    $app->start();

    $app->stop();
}
catch(\Exception $e)
{
    echo $e->getMessage();

    exit;
}