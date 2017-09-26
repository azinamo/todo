<?php
namespace Todo;
class DBConn
{
    private static $instance;
    /**
     * resource
     **/
    protected $dbResource = NULL;
    /**
     * host
     **/
    protected $dbHost 	  = "localhost";
    /**
     * name
     **/
    protected $dbName 	  = "";
    /**
     * password
     **/
    protected $dbPassword = "";
    /**
     * username
     **/
    protected $dbUser     = "root";

    private function __construct()
    {
        try
        {
            if(!$this->dbResource = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPassword)) {
                throw new Exception("An error occured connecting to the databse ".mysqli_error()."\r\n host => ".$this->dbHost." user => ".$this->dbUser." Password => ".$this->dbPassword);
            }
            if( !mysqli_select_db($this->dbName, $this->dbResource)) {
                throw new Exception("An error selection the specified database ".mysqli_error()."\r\n\n");
            }
        } catch( Exception $e ) {
            echo "Error => ".$e->getMessage();
        }
    }

    //set the databse name
    function setDbName( $dbname = "" )
    {
        $this->dbName = $dbname;
    }

    //set the username for the database
    function setDbUser( $dbuser = "" )
    {
        $this->dbUser  = $dbuser;
    }

    //set the password of the database
    function setDbPassword( $dbpass = "" )
    {
        $this->dbPassword = $dbpass;
    }
    //set the databse host
    function setDbHost( $dbhost = "" )
    {
        $this->dbHost = $dbhost;
    }

    //create an instance of the database
    public static function getInstance()
    {
        if (!self::$instance )  self::$instance = new Database();
        return self::$instance;
    }

}