<?php
/**
 *
 * Validator Facade
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Validator extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'validator';
    }

}