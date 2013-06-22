<?php namespace Core;
/**
 *
 * Core Assembler
 *
 * Assembles the Core components, which also serves as the IoC Container
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Assembler
{
    protected $components = array();

    public function __set($id, $component)
    {
        $this->components[$id] = $component;
    }

    public function __get($id)
    {
        if(is_callable($this->components[$id]))
        {
            return $this->components[$id]($this);
        }

        return $this->components[$id];
    }
}
