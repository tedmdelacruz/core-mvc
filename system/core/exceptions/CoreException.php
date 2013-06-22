<?php namespace Core\Exceptions;
/**
 *
 * Core Exception
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class CoreException extends \Exception
{

    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}