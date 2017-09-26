<?php
namespace Todo;

class DBConn
{
    private static $instance;

    protected $dbUser     = "root";

    private function __construct()
    {
        try {
            // Connect to server and select database.
            $this->conn = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME. ';charset=utf8', DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die('Database connection error '.$e->getMessage());
            //error_log('Database connection error '.$e);
        }

    }

    //create an instance of the database
    public static function getInstance()
    {
        if (!self::$instance )  self::$instance = new DBConn();
        return self::$instance;
    }

}