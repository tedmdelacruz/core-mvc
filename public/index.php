<?php
/*
|--------------------------------------------------------------------------
| Core MVC
|--------------------------------------------------------------------------
| Core is an experimental micro PHP MVC framework
|
| Created by Ted Mathew dela Cruz as a case study for PHP OOP concepts,
| Facade design pattern, and MVC framework construction from scratch
|
*/

/*
|--------------------------------------------------------------------------
| Core system path
|--------------------------------------------------------------------------
*/
$system_path = '../system/';

/*
|--------------------------------------------------------------------------
| Core application path
|--------------------------------------------------------------------------
*/
$app_path = '../app/' ;

/*
|--------------------------------------------------------------------------
| Validate paths
|--------------------------------------------------------------------------
*/
if (realpath($system_path) !== FALSE)
{
    $system_path = realpath($system_path).'/';
}
else
{
    exit('The system path seems to be not set correctly. Set it correctly in: '.__FILE__);
}

if (realpath($app_path) !== FALSE)
{
    $app_path = realpath($app_path).'/';
}
else
{
    exit('The application path seems to be not set correctly. Set it correctly in: '.__FILE__);
}

// Ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';

/*
|--------------------------------------------------------------------------
| Define the global Core path constants
|--------------------------------------------------------------------------
*/
define('SYS_PATH', $system_path);

define('APP_PATH', $app_path);

/*
|--------------------------------------------------------------------------
| Setup more constants
|--------------------------------------------------------------------------
*/
require SYS_PATH.'constants.php';

/*
|--------------------------------------------------------------------------
| Core global functions
|--------------------------------------------------------------------------
*/
require SYS_PATH.'common.php';

/*
|--------------------------------------------------------------------------
| Initialize the class autoloader
|--------------------------------------------------------------------------
*/
require SYS_PATH.'autoload.php';

/*
|--------------------------------------------------------------------------
| All systems go
|--------------------------------------------------------------------------
*/
require SYS_PATH.'start.php';