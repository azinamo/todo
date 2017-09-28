<?php
namespace Todo;

class DBConn
{
    private static $instance;

    private $connection;

    private function __construct()
    {
        try {
            // Connect to server and select database.
            $this->connection = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME. ';charset=utf8', DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            error_log('Database connection error '.$e);
            die('Database connection error, please ensure database settings are correct');
        }

    }

    private function __clone() { }

    public function connect()
    {
        return $this->connection;
    }


    //create an instance of the database
    public static function getInstance()
    {
        if (!self::$instance) self::$instance = new DBConn();
        return self::$instance;
    }

}