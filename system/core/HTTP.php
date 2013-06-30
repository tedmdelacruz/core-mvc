<?php
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

namespace Core;

class Http
{
    /**
     * HTTP Status errors
     * @var array
     */
    private $status = array(
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
    public function status_code($code)
    {
        if(isset($this->status[$code]))
        {
            $status = $this->status[$code];
        }
        else
        {
            $status = 500;
        }

        header("HTTP/1.0 {$code} {$status}");
    }

    public function header($content){
        header($content);
        exit;
    }
}