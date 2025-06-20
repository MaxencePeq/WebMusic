<?php

namespace Entity;

use Database\MyPdo;

class song {
    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Renvoie un son par depuis son ID
     * @param int $songId
     * @return song
     */
    public static function findById(int $songId): Song{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM song WHERE id = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, Song::class);
        $query->execute([$songId]);
        return $query->fetch();
    }

    public static function findTrackBySongId(int $songId): track{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM track t join song s on t.songId = s.id WHERE s.id = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, track::class);
        $query->execute([$songId]);
        return $query->fetch();
    }

}