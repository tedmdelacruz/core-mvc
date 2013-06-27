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
        require CONFIG_DIR . 'config.php';
        require CONFIG_DIR . 'database.php';
        require CONFIG_DIR . 'auth.php';

        $this->config   = $config;
        $this->database = $db;
        $this->auth     = $auth;
    }

    /**
     * Get config parameter from APP_PATH/config/
     *
     * @param  string $config target config file (auth, config, database, ...)
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