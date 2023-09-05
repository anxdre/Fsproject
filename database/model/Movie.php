<?php
namespace database\model;

use database\DbDriver;

require_once("./database/DbDriver.php");

class Movie
{
    private $conn;
    private $id;
    private $title;
    private $releaseDate;
    private $rating;
    private $synopsis;
    private $serial;
    private $genre;

    public function __construct()
    {
        $driver = new DbDriver();
        $this->conn = $driver->getConnection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * @param mixed $synopsis
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    /**
     * @return mixed
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * @param mixed $serial
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }


    public function fetchAll()
    {
        $query = "SELECT * FROM movie";
        $row = $this->conn->query($query);
        return $row->fetch_all();
    }

    public function addItem($title, $releaseDate, $rating, $synopsis, $serial, $genre)
    {
        $query = "INSERT INTO movie (title,release_date,rating,synopsis,serial,genre) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisss", $title, $releaseDate, $rating, $synopsis, $serial, $genre);
        return $stmt->execute();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}