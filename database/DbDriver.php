<?php
namespace database;
use Exception;
use mysqli;

class DbDriver
{
    private $host = "localhost";
    private $username = "anxdre";
    private $password = ".Anxdre000";
    private $database = "mydb";
    private $port = 3306;

    /**
     * @return mysqli
     */
    public function getConnection()
    {
        try {
            return new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);
        } catch (Exception $e) {
            echo "Error : " . $e->getCode() . " caused By : " . $e->getMessage();
            return false;
        }
    }

}


