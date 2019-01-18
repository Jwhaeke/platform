<?php
namespace Platform;

abstract class Data
{
    protected $connection = NULL;
    
    function __construct(){
    $this->connection = new \PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    function __destruct() {
    $this->connection = NULL;
    }


}

?>