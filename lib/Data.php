<?php
namespace Platform;



class Data
{
    protected $connection = NULL;
    
    function __construct(){
    $this->connection = new \PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    }

    function __destruct() {
    $this->connection = NULL;
    }
}



?>