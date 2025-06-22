<?php

namespace Entity;

use Database\MyPdo;

class artist {
    private int $id;
    private string $name;

    public function getName(): string|bool
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Renvoie un artist depuis son ID
     * @param int $artistId
     * @return artist
     */
    public static function findById (int $artistId):artist{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM artist WHERE id = ?");
        $query->setFetchMode(MyPdo::FETCH_CLASS, Artist::class);
        $query->execute([$artistId]);
        return $query->fetch();
    }

    /**
     * Renvoie un artist depuis son ID
     * @param int $artistId
     * @return artist
     */
    public static function FindArtistByArtistId(int $artistId): Artist{
        $query = MyPdo::getInstance()->prepare("SELECT id, name FROM artist WHERE id= ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, Artist::class);
        $query->execute([$artistId]);
        return $query->fetch();
    }

    /**
     * Renvois un artist depuis son ID
     * @param int $artistId
     * @return artist
     */
    public static function findByGenreId(int $artistId): artist{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM artist WHERE id = ?");
        $query->setFetchMode(PDO::FETCH_CLASS, artist::class);
        $query->execute([$artistId]);
        return $query->fetch();
    }

    /**
     * Renvoie tous les albums d'un artist
     * @return album[]
     */
    public static function getAllAlbum(int $artistId):array{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM album WHERE artistId = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, Album::class);
        $query->execute([$artistId]);
        return $query->fetchAll();
    }

}