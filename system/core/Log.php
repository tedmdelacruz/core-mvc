<?php
/**
 *
 * Log
 *
 * Core logging utility
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core;

class Log
{
    /**
     * Stack trace
     * @var array
     */
    private static $stack = array();

    /**
     * Trace the current line
     * @param  string $class  current class
     * @param  string $method current method
     * @param  string $msg    (optional)
     * @return void
     */
    public static function trace($location, $msg = NULL)
    {
        // Build the stack message
        $entry = '[' . date("Y/m/d h:i:s", time()) . '] ';
        $entry .= $location . ' ';
        $entry .= $msg;

        self::$stack[] = $entry;
    }

    /**
     * Adds a message to the stack
     * @param  string $message
     * @return void
     */
    public static function message($message)
    {
        self::$stack[] = $message;
    }

    /**
     * Displays an HTML output of the current stack for debugging
     * @return void
     */
    public static function output()
    {
        $stack = self::$stack;

        require_once 'views/debug.php';

        exit;
    }
}