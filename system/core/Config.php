<?php namespace Core;
/**
 *
 * Configuration
 *
 * Handles all configuration parameters throughout the app
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class Config
{

    private $config;
    private $database;
    private $auth;

    /**
     * Include the configuration files
     */
    public function __construct()
    {
        $config_file          = CONFIG_DIR . 'config.php';
        $database_config_file = CONFIG_DIR . 'database.php';
        $auth_config_file     = CONFIG_DIR . 'auth.php';

        $this->config   = require_once $config_file;
        $this->database = require_once $database_config_file;
        $this->auth     = require_once $auth_config_file;
    }

    /**
     * Get config parameter from APP_PATH/config/config.php
     *
     * @param  string $config target config file (auth, config, database)
     * @param  string $param  parameter to obtain (optional)
     * @return mixed  configuration parameter
     */
    public function get($config, $param = null)
    {
        if($param)
        {
            return $this->{$config}[$param];
        }

        return $this->{$config};
    }

    /**
     * Determines if configuration is defined or not
     *
     * @param  string $config configuration to retrieve
     * @param  string $param (optional)
     * @return boolean
     * @todo   actually use $config to figure out if a config is defined
     */
    public function isDefined($config, $param = null)
    {
        if($this->database['host'] == null)
        {
            return false;
        }

        return true;
    }
}