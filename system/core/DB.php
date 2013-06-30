<?php
/**
 *
 * Database
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 */

namespace Core;

class DB
{

    private $config;

    private $PDO;

    private $host;
    private $username;
    private $password;
    private $port;
    private $dbName;

    /**
     * Sets database fetch type. Either Array or Object
     * @access private
     * @var int
     */
    private $fetchType = \PDO::FETCH_OBJ;

    /**
     * Current SQL string
     * @access private
     * @var string
     */
    private $sql = "";

    /**
     * SQL columns
     * @access private
     * @var string
     */
    private $columns = '*';

    /**
     * SQL table
     * @access private
     * @var string
     */
    private $table = "";

    /**
     * SQL where column
     * @var string
     */
    private $where = "";
    /**
     * Parameters for PDO binding
     * @access private
     * @var array
     */
    private $parameters = array();

    /**
     * Regular Expression for matching SQL logical operators
     * @var string
     */
    private $operators = '/(=)|(!=)|(<>)|(>=)|(<=)|(<)|(>)|(NOT IN)|(IN)|(IS NOT)|(IS)|(not in)|(in)|(is not)|(is)/';

    /**
     * Initialize the DB
     * @access public
     * @param Config $config Config instance for obtaining db parameters
     * @param Log $log
     */
    public function __construct(Config $config)
    {
        Log::trace(__METHOD__);

        $db = $config->get('database');

        $this->host     = $db['host'];
        $this->dbName   = $db['db_name'];
        $this->username = $db['username'];
        $this->password = $db['password'];
        $this->port     = $db['port'];
    }

    public function connect()
    {
        if( is_object($this->PDO) ) return $this->PDO;

        try
        {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            Log::trace(__METHOD__, 'Connection: ' . $connection);

            $this->PDO = new \PDO($connection, $this->username, $this->password);
            $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e)
        {
            echo "Could not connect to the database. </br>";
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * Set the PDO fetch type
     *
     * @access  public
     * @param   string $fetchType 'object' or 'array'
     */
    public function setFetchType($fetchType)
    {
        Log::trace(__METHOD__);

        if($fetchType == 'array')
        {
            $this->fetchType = \PDO::FETCH_ARR;
        }
        else
        {
            $this->fetchType = \PDO::FETCH_OBJ;
        }
    }

    /**
     * Adds a parameter to the parameters list
     * @param  string $field     field to compare with
     * @param  mixed  $parameter (optional) PDO parameter bindings
     */
    public function addParameter($field, $parameter = NULL)
    {
        // Strip all operators in where column
        $column = rtrim(preg_replace($this->operators, '', $field));

        if( $parameter )
        {
            $this->parameters[$column] = $parameter;
        }
    }

    /**
     * Prepare the SELECT clause
     * @access public
     * @param  string $columns
     */
    public function select($columns)
    {
        Log::trace(__METHOD__);

        $this->columns = $columns;
        $this->sql .= "SELECT {$columns} ";
    }

    /**
     * Prepare the WHERE clause and parameter bindings, if provided
     * Adds an equal sign accordingly
     *
     * Ex:
     *    DB::where('id', 1234);
     *    WHERE id = :id
     *
     * @access public
     * @param  string $whereCol Where column
     * @param  mixed  $parameter (optional) PDO parameter bindings
     * @return void
     */
    public function where($whereCol, $parameter = null)
    {
        $where = 'WHERE ';

        $this->addParameter($whereCol, $parameter);

        // Intelligently add the equal sign
        if( ! preg_match($this->operators, $whereCol) )
        {
            $whereCol .= ' = ';
        }

        $where .= $whereCol;

        $this->where = $where . ' ' . $this->generateBindings(array_keys($this->parameters));

        Log::trace(__METHOD__ , "[$this->where]");
    }

    /**
     * Prepares a like condition
     * @param  string $field    field to compare to
     * @param  string $string   query string
     * @param  string $wildcard (optional)[both, left, right] wildcard position(s)
     * @return void
     */
    public function like($field, $string, $wildcard = NULL)
    {
        $this->where = "";

        if( empty($this->where) )
        {
            $this->where = "WHERE ";
        }
        else
        {
            $this->where .= "AND ";
        }

        $this->addParameter($field, $string);

        $this->where .= " {$field} LIKE " . $this->generateBindings(array_keys($this->parameters));

        Log::trace(__METHOD__ , "[PARAMETERS: " . implode(',', $this->parameters) . "]");
    }

    /**
     * Sets the table to be fetched from
     * @param  string $table
     * @return void
     */
    public function from($table)
    {
        Log::trace(__METHOD__, "[$table]");

        $this->table = $table;
    }

    /**
     * Get records from a table
     *
     * @param  string $table (optional)
     * @access public
     * @return array  Array of objects
     */
    public function get($table = NULL)
    {
        Log::trace(__METHOD__);

        // if table is not set, use the table set earlier with DB::from()
        if( ! $table )
        {
            $table = $this->table;
        }

        try
        {
            $sql = "SELECT {$this->columns} FROM {$table} ";

            if( $this->where )
            {
                $sql .= $this->where;
            }

            $statement = $this->PDO->prepare($sql);

            if( ! empty($this->parameters))
            {
                $statement->execute($this->parameters);
            }
            else
            {
                $statement->execute();
            }

            $result = $statement->fetchAll($this->fetchType);

            $this->reset();

            return $result;
        }
        catch(\PDOException $e)
        {
            throw new Exceptions\CoreException($e->getMessage());
        }
    }

    /**
     * Get one record from a table
     *
     * @param  string $table (optional)
     * @access public
     * @return array  Array of objects
     */
    public function getOne($table = NULL)
    {
        if( ! $table )
        {
            $table = $this->table;
        }

        try
        {
            $sql = "SELECT {$this->columns} FROM {$table} ";

            if( $this->where )
            {
                $sql .= $this->where;
            }

            $statement = $this->PDO->prepare($sql);

            Log::trace(__METHOD__, "Executing SQL: $sql");
            Log::trace(__METHOD__, "Parameter keys: " . implode(',', array_keys($this->parameters)));
            Log::trace(__METHOD__, "Parameters: " . implode(',', $this->parameters));

            if( ! empty($this->parameters))
            {
                $statement->execute($this->parameters);
            }
            else
            {
                $statement->execute();
            }

            $result = $statement->fetch($this->fetchType);

            (is_object($result)
                ? Log::trace(__METHOD__, "[ID:$result->id][USER:$result->username][PASS:$result->password]")
                : Log::trace(__METHOD__, 'returned false'));

            $this->reset();

            return $result;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage(); exit;
            throw new Exceptions\CoreException($e->getMessage());
        }
    }

    /**
     * Inserts a record to the table
     * @param  string  $table
     * @param  array   $record
     * @return boolean
     */
    public function insert($table, $record)
    {
        try
        {
            $sql = "INSERT INTO {$table} (" . implode(', ', array_keys($record));
            $sql .= ') VALUES (' . $this->generateBindings(array_keys($record)) . ')';

            Log::trace(__METHOD__, 'Executing SQL: ' . $sql);

            $statement = $this->PDO->prepare($sql);

            $statement->execute($record);

            $this->reset();

            return TRUE;

        }
        catch(\PDOException $e)
        {
            return FALSE;
        }
    }

    /**
     * Generates PDO parameter bindings
     *
     * Ex:
     *     $fields = array('username', 'email')
     *     returns ':username, :email'
     *
     * @param  array $fields array of fields to bind
     * @return string        parameter bindings
     */
    private function generateBindings($fields)
    {
        // Add a colon to each field
        array_walk($fields, function(&$field){
            $field = ':' . $field . ' ';
        });

        $bindings = implode(', ', $fields);

        Log::trace(__METHOD__, "[$bindings]");

        return $bindings;
    }

    /**
     * Returns the last inserted ID
     * @param  string $name column name containing pk
     * @return int
     */
    public function getLastInsertId($name = NULL)
    {
        $id = $this->PDO->lastInsertId($name);

        Log::trace(__METHOD__, "[ID: $id]");

        return $id;
    }

    /**
     * Resets the main SQL components
     * @return void
     */
    private function reset()
    {
        Log::trace(__METHOD__, "[SQL:$this->sql][COLS:$this->columns][TABLE:$this->table][WHERE:$this->where][PARAMS: ".implode(',', $this->parameters). "]");

        $this->sql        = "";
        $this->columns    = "*";
        $this->table      = "";
        $this->where      = "";

        $this->parameters = array();;
    }

}
