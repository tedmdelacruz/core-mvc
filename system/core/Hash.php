<?php
/**
 *
 * Hash
 *
 * Relies on PasswordHash third-party library
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core;

class Hash
{
    private $hasher;

    public function __construct(\PasswordHash $passwordHash)
    {
        $this->hasher = $passwordHash;
    }

    public function generate($string)
    {
        return $this->hasher->HashPassword($string);
    }

    public function check($hash1, $hash2)
    {
        return $this->hasher->CheckPassword($hash1, $hash2);
    }
}