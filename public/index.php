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
$systemPath = '../system/';

/*
|--------------------------------------------------------------------------
| Core application path
|--------------------------------------------------------------------------
*/
$appPath = '../app/' ;

/*
|--------------------------------------------------------------------------
| Vendors path
|--------------------------------------------------------------------------
*/
$vendorsPath = '../vendor/' ;

/*
|--------------------------------------------------------------------------
| Validate paths
|--------------------------------------------------------------------------
*/
if ( FALSE !== realpath($systemPath) )
{
    $systemPath = realpath($systemPath).'/';
}
else
{
    exit('The system path seems to be not set correctly. Set it correctly in: '.__FILE__);
}

if ( FALSE !== realpath($appPath))
{
    $appPath = realpath($appPath).'/';
}
else
{
    exit('The application path seems to be not set correctly. Set it correctly in: '.__FILE__);
}

if ( FALSE !== realpath($vendorsPath))
{
    $vendorsPath = realpath($vendorsPath).'/';
}
else
{
    exit('The vendors path seems to be not set correctly. Set it correctly in: '.__FILE__);
}

// Ensure there's a trailing slash
$systemPath = rtrim($systemPath, '/').'/';

$appPath = rtrim($appPath, '/').'/';

$vendorsPath = rtrim($vendorsPath, '/').'/';

/*
|--------------------------------------------------------------------------
| Define the global Core path constants
|--------------------------------------------------------------------------
*/
define('SYS_PATH', $systemPath);

define('APP_PATH', $appPath);

define('VENDORS_DIR', $vendorsPath);

/*
|--------------------------------------------------------------------------
| Define more path constants
|--------------------------------------------------------------------------
*/
require SYS_PATH . 'constants.php';

/*
|--------------------------------------------------------------------------
| Core global functions
|--------------------------------------------------------------------------
*/
require SYS_PATH . 'common.php';

/*
|--------------------------------------------------------------------------
| Initialize the class autoloaders
|--------------------------------------------------------------------------
*/
require SYS_PATH . 'autoload.php';

/*
|--------------------------------------------------------------------------
| Build the application
|--------------------------------------------------------------------------
*/
require SYS_PATH . 'build.php';