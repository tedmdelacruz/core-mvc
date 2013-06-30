<?php
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

namespace Core;

class Input
{
    private $post_data;

    public function __construct()
    {
        $this->post_data = $_POST;
    }

    /**
     * Gets all or one POST data
     * @param  string $post_index (optional) index of POST data
     * @return mixed
     */
    public function post($post_index = null)
    {
        // If POST index is not defined, return all
        if( ! $post_index)
        {
            return $this->post_data;
        }

        if( isset($this->post_data[$post_index]) )
        {
            return $this->post_data[$post_index];
        }

        return NULL;
    }
}