<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Core Autoloaders
|--------------------------------------------------------------------------
|
*/

function classLoader($namespace)
{
    $path = getFilePath($namespace);

    $classFile = SYS_PATH . $path . '.php';

    // echo __FUNCTION__ . ': ' . $classFile . '<br/>';

    if(is_file($classFile))
    {
        require_once $classFile;
    }
}

function facadeLoader($namespace)
{
    $classFile = SYS_PATH . 'facades/' . $namespace . '.php';

    if(is_file($classFile))
    {
        require_once $classFile;
    }
}

function controllerLoader($class) {
    $classFile = CONTROLLERS_DIR . ucfirst($class) . '.php';

    if(is_file($classFile)) {
        require_once $classFile;
    }
}

function modelLoader($class) {
    $classFile = MODELS_DIR . ucfirst($class) . '.php';

    if(is_file($classFile)) {
        require_once $classFile;
    }
}

spl_autoload_register('classLoader');
spl_autoload_register('facadeLoader');
spl_autoload_register('controllerLoader');
spl_autoload_register('modelLoader');
