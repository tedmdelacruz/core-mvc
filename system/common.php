<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Global Core functions
|--------------------------------------------------------------------------
|
*/

/**
 * Obtains a configuration paramameter without an instance of Core\Config
 *
 * @param  string $config config file without extension
 * @param  string $param  config parameter
 * @return mixed
 * @todo   needs refactoring
 */
function getConfig($configName, $param)
{
    $config = array();

    $configFile = CONFIG_DIR . $configName . '.php';

    if( file_exists($configFile) )
    {
        require $configFile;

        if( isset($config[$param]) )
        {
            return $config[$param];
        }
    }

    return NULL;
}

/**
 * Returns the base URL. Accepts an optional resource.
 * If the resource given is invalid, returns the base URL
 *
 * @param  string $url URL to append
 * @return string      generated URL
 */
function baseURL($resource = NULL)
{
    $baseUrl = getConfig('config', 'base_url');
    // If base URL is not defined, intelligently obtain the base URL
    // by referring to the location of index.php
    if( ! $baseUrl )
    {
        $dirName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);

        $host = $_SERVER['SERVER_NAME'];

        $baseUrl = 'http://' . $host . $dirName;
    }

    // Make sure that the base URL has a trailing backslash
    $baseUrl = rtrim($baseUrl, '/') . '/';

    // Return the current base URL if there is no resource locator defined
    if( ! $resource ) return $baseUrl;

    $generatedURL = $baseUrl . $resource;

    // if generated URL is invalid, return base URL
    if( ! filter_var($generatedURL, FILTER_VALIDATE_URL)) return $baseUrl;

    return $generatedURL;
}

/**
 * Obtain the file path of the full namespace
 * @param  string $namespacePath full namespace
 * @return string                file path
 */
function getFilePath($namespacePath)
{
    $path = '';
    $namespaces = explode('\\', $namespacePath);

    for( $i = 0 ; $i < count($namespaces) ; $i++ )
    {
        // Do not uncapitalize the last namespace
        if($i == count($namespaces) - 1)
        {
            $path .= '\\'.$namespaces[$i];
        }
        else
        {
            $path .= '\\'.strtolower($namespaces[$i]);
        }
    }

    // Remove trailing forward slashes
    return trim($path, '\\');
}