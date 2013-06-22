<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');

class User extends Model
{

    public static function get()
    {
        return DB::get('users');
    }

}