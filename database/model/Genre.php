<?php

namespace database\model;

use database\DbDriver;

require_once("./database/DbDriver.php");

class Genre
{
private $conn;
private $idGenre;
private $name;

    public function __construct()
    {
        $driver = new DbDriver();
        $this->conn = $driver->getConnection();
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    public function getIdGenre()
    {
        return $this->idGenre;
    }

    public function setIdGenre($idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAll(){
        $query = "SELECT * FROM genre";
        $row = $this->conn->query($query);
        return $row->fetch_all(MYSQLI_ASSOC);
    }

    public function getByMovie($idMovie){
        $query = "SELECT a.* FROM movies_has_genre
           INNER JOIN actor a ON movies_has_genre.genre_id = a.id
           WHERE id = $idMovie";
        $row = $this->conn->query($query);
        return $row->fetch_all(MYSQLI_ASSOC);
    }

}