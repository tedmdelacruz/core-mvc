<?php namespace Core;
/**
 *
 * Input
 *
 * Handles all incoming server request data
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Input
{
    private static $post_data;

    public function __construct()
    {
        self::$post_data = $_POST;
    }

    public static function post($post_index = null)
    {
        return self::$post_data;
    }
}