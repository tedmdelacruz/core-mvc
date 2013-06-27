<?php namespace Core;
/**
 *
 * Database
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */
class DB
{

    private $config;

    private static $PDO;

    private static $host;
    private static $username;
    private static $password;
    private static $port;
    private static $db_name;

    /**
     * Sets database fetch type. Either Array or Object
     * @access private
     * @var int
     */
    private static $fetch_type = \PDO::FETCH_OBJ;

    /**
     * Current SQL string
     * @static
     * @access private
     * @var string
     */
    private static $sql = "";

    /**
     * SQL columns
     * @static
     * @access private
     * @var string
     */
    private static $columns = '*';

    /**
     * Where clause parameters for PDO binding
     * @static
     * @access private
     * @var array
     */
    private static $parameters = array();

    /**
     * Initialize the DB
     * @access public
     * @param Config $config Config instance for obtaining db parameters
     */
    public function __construct(Config $config)
    {
        $db = $config->get('database');

        self::$host     = $db['host'];
        self::$db_name  = $db['db_name'];
        self::$username = $db['username'];
        self::$password = $db['password'];
        self::$port     = $db['port'];
    }

    public function connect()
    {
        if((bool) self::$PDO) return;

        $connection = "mysql:host=" . self::$host . ";dbname=" . self::$db_name;

        self::$PDO = new \PDO($connection, self::$username, self::$password);
        self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Set the PDO fetch type
     *
     * @static
     * @access  public
     * @param   string $fetch_type 'object' or 'array'
     */
    public static function set_fetch_type($fetch_type)
    {
        if($fetch_type == 'array')
        {
            self::$fetch_type = \PDO::FETCH_ARR;
        }
        else
        {
            self::$fetch_type = \PDO::FETCH_OBJ;
        }
    }

    /**
     * Prepare the SELECT clause
     * @static
     * @access public
     * @param  string $columns
     */
    public static function select($columns)
    {
        self::$columns = $columns;
        self::$sql .= "SELECT {$columns} ";
    }

    /**
     * Prepare the WHERE clause and parameter bindings, if provided
     *
     * DB::where('id', 1234);
     * WHERE id = :id
     *
     * @static
     * @access public
     * @param  string $where_col Where column
     * @param  mixed  $parameter (optional) PDO parameter bindings
     */
    public static function where($where_col, $parameter = null)
    {
        $where = 'WHERE ' . $where_col;

        if((bool) $parameter)
        {
            // Add the parameter to the params list, to be binded on execution
            if(is_string($parameter))
            {
                self::$parameters[$where_col] = "'{$parameter}'";
            }
            else
            {
                self::$parameters[$where_col] = $parameter;
            }
        }

        self::$sql .= $where;
    }

    /**
     * Get records of a table
     *
     * @static
     * @param  string $table
     * @access public
     * @return array  Array of objects
     */
    public static function get($table)
    {
        $columns = self::$columns;

        try {

            $sql = "SELECT {$columns} FROM {$table}";

            $statement = self::$PDO->prepare($sql);

            if( ! empty(self::$parameters))
            {
                $statement->execute(self::$parameters);
            }
            else
            {
                $statement->execute();
            }

            return $statement->fetchAll(self::$fetch_type);

        } catch(PDOException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Debug
     *
     * @static
     * @access public
     */
    public static function debug()
    {
        $debug['debug']['host']       = self::$host;
        $debug['debug']['db_name']    = self::$db_name;
        $debug['debug']['username']   = self::$username;
        $debug['debug']['password']   = self::$password;
        $debug['debug']['sql']        = self::$sql;
        $debug['debug']['columns']    = self::$columns;
        $debug['debug']['parameters'] = self::$parameters;

        View::render('debug', $debug);
    }
}