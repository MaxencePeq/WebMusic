<?php

namespace Entity;

use Database\MyPdo;

class album {
    private int  $id;
    private string $name;
    private int $year;
    private int $artistId;
    private int $genreId;
    private int $coverId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCoverId(): int
    {
        return $this->coverId;
    }

    public function getGenreId(): int
    {
        return $this->genreId;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Renvoie un album depuis son Id
     * @param int $albumId
     * @return album
     */
    public static function findById(int $albumId): album{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM album WHERE id = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, Album::class);
        $query->execute([$albumId]);
        return $query->fetch();
    }

}