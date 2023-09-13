<?php

namespace database\model;

use database\DbDriver;
use mysql_xdevapi\Exception;

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
        $query = "SELECT * FROM movie ";
        $row = $this->conn->query($query);
        return $row->fetch_all(MYSQLI_ASSOC);
    }

    public function addItem($title, $releaseDate, $rating, $synopsis, $serial)
    {
        $query = "INSERT INTO movies (title,release_date,rating,synopsis,serial) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->bind_param("ssisi", $title, $releaseDate, $rating, $synopsis, $serial);
            $stmt->execute();
            return $stmt->insert_id;
        } catch (Exception $e) {
            echo $stmt->error_list;
        }
    }

    public function addGenre($idMovie, $listOfGenre)
    {
        $query = "INSERT INTO movies_has_genre (movies_id,genre_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        if ($listOfGenre != null) {
            foreach ($listOfGenre as $item) {
                try {
                    $stmt->bind_param("ii", $idMovie, $item);
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $stmt->error_list;
                }
            }
            return true;
        }
    }

    public function addActor($idMovie, $listOfActor, $listOfRole)
    {
        $query = "INSERT INTO movies_has_actor (movies_id,actor_id,peran) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);
        if ($listOfActor != null) {
            for($i = 0; $i < count($listOfActor);$i++) {
                try {
                    $stmt->bind_param("iis", $idMovie, $listOfActor[$i],$listOfRole[$i]);
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $stmt->error_list;
                    return false;
                }
            }
            return true;
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}