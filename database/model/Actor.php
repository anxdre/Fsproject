<?php

namespace database\model;
use database\DbDriver;
require_once ("./database/DbDriver.php");

class Actor
{
    private $idActor;
    private $name;
    private $gender;

    public function __construct()
    {
        $driver = new DbDriver();
        $this->conn = $driver->getConnection();
    }

    public function getIdActor()
    {
        return $this->idActor;
    }

    public function setIdActor($idActor)
    {
        $this->idActor = $idActor;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getAll(){
        $query = "SELECT * FROM actor";
        $row = $this->conn->query($query);
        return $row->fetch_all(MYSQLI_ASSOC);
    }
    public function getByMovie($idMovie){
        $query = "SELECT a.* FROM movies_has_actor
           INNER JOIN actor a ON movies_has_actor.actor_id = a.id
           WHERE id = $idMovie";
        $row = $this->conn->query($query);
        return $row->fetch_all(MYSQLI_ASSOC);
    }
}