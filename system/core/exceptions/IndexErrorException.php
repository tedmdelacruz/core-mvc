<?php
/**
 *
 * Index Error Exception
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core\Exceptions;

class IndexErrorException extends CoreException
{

    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}