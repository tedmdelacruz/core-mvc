<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Core Constants
|--------------------------------------------------------------------------
|
*/
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/core/public/'); // I'm not sure about this

define('CORE_CLASSES_DIR', SYS_PATH . 'core/');

/*
|--------------------------------------------------------------------------
| Application Constants
|--------------------------------------------------------------------------
*/
define('CONTROLLERS_DIR', APP_PATH . 'controllers/');

define('CONFIG_DIR', APP_PATH . 'config/');

define('MODELS_DIR', APP_PATH . 'models/');

define('LIBRARIES_DIR', APP_PATH . 'libraries/');

define('VIEWS_DIR', APP_PATH . 'views/');