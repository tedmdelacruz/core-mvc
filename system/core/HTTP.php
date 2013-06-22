<?php namespace Core;
/**
 *
 * HTTP
 *
 * Manages HTTP responses
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Http
{
    /**
     * HTTP Status errors
     * @var array
     */
    private static $status = array(
        404 => 'Not Found',
        500 => 'Internal Server Error'
    );

    /**
     * HTTP status code handler
     *
     * Handles basic HTTP header status code generation
     *
     * @param  int $code HTTP status code
     */
    public static function status_code($code)
    {
        if(isset(self::$status[$code]))
        {
            $status = self::$status[$code];
        }
        else
        {
            $status = 500;
        }

        header("HTTP/1.0 {$code} {$status}");
    }

    public static function header($content){
        header($content);
    }
}