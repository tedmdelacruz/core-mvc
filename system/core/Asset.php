<?php
/**
 *
 * Asset
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core;

class Asset
{

    private $assets = array();

    /**
     * Adds an asset to the assets list to be added with Asset::url()
     * @param string $name  asset name
     * @param string $asset asset file
     */
    public function add($name, $asset)
    {
        $this->assets[$name] = $asset;
    }

    /**
     * Generates a url to the asset given
     * @param  string $index  asset name
     */
    public function url($index)
    {
        if(isset($this->assets[$index]))
        {
            echo \baseUrl($this->assets[$index]);
        }
        else
        {
            throw new \Exception("Asset '{$index}' not yet defined");
        }
    }
}