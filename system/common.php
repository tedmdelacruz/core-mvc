<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Global Core functions
|--------------------------------------------------------------------------
|
*/

/**
 * Appends a resource to the Core base url
 * @param  string $url URL to append
 * @return string      generated URL
 */
function base_url($url)
{
    return BASE_URL . $url;
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