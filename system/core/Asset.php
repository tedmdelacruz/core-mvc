<?php namespace Core;

/**
 *
 * Asset
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Asset
{

    private $assets = array();

    public function add_asset($name, $asset)
    {
        $this->assets[$name] = $asset;
    }

    public function url($index)
    {
        if(isset($this->assets[$index]))
        {
            echo BASE_URL . $this->assets[$index];
        }
        else
        {
            throw new \Exception("Asset '{$index}' not yet defined");
        }
    }
}