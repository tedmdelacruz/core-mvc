<?php
/**
 *
 * Core MVC Inversion of Control Container
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 *
 */

namespace Core;

class IoC
{
    protected $closures = array();

    protected $objects = array();

    public function __set($id, \Closure $closure)
    {
        $this->closures[$id] = $closure;
    }

    public function __get($id)
    {
        // If the closure has already been set
        // and object instance is in the list of objects
        if(isset($this->closures[$id])
            and is_callable($this->closures[$id])
            and isset($this->objects[$id])
        ){
            // return the existing object
            return $this->objects[$id];
        }

        // Else create a new instance and add to the list of objects
        return $this->objects[$id] = $this->closures[$id]($this);
    }

    public function getObjects()
    {
        return $this->objects;
    }
}