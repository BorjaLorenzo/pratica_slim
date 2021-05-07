<?php

class BaseDatos
{
    protected $servername = null;
    protected $database = null;
    protected $username = null;
    protected $password = null;
    protected $con = null;

    protected static $singleton=null;

    function __construct()
    {
        $this->servername = "127.0.0.1";
        $this->database = "desatranques";
        $this->username = "root";
        $this->password = "";
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
    }
    /**
     * Patron Singleton, solo una conexion
     */
    public static function getInstance()
    {
        if (self::$singleton) {
            return self::$singleton;
        }
        
        return self::$singleton = new self();
    }

    public function Conexion(){
        return $this->con;
    }

    
    
    
    
    
    
    
    
    
}
