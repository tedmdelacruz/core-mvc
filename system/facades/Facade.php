<?php
/**
 *
 * Facade
 *
 * Mimics static calls of classes to hide code complexity
 *
 * Credits to Laravel Facade
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
abstract class Facade
{

    protected static $app;

    /**
     * Get the application instance behind the facade.
     *
     * @return App $app
     */
    public static function getAppInstance()
    {
        return static::$app;
    }

    /**
     * Set the application instance.
     *
     * @param  App  $app
     */
    public static function setAppInstance($app)
    {
        static::$app = $app;
    }

    /**
     * Resolve the component instance from the container.
     *
     * @param  string  $name
     * @return mixed
     */
    protected static function resolveInstance($name)
    {
        if (is_object($name)) return $name;

        if (isset(static::$app->$name))
        {
            return static::$app->$name;
        }

        return static::$app->$name;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        throw new \RuntimeException("Facade does not implement getFacadeAccessor method.");
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::resolveInstance(static::getFacadeAccessor());

        switch (count($args))
        {
            case 0:
                return $instance->$method(); break;

            case 1:
                return $instance->$method($args[0]); break;

            case 2:
                return $instance->$method($args[0], $args[1]); break;

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]); break;

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]); break;

            default:
                return call_user_func_array(array($instance, $method), $args); break;
        }
    }

}