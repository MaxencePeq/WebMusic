<?php

namespace Entity;

use Database\MyPdo;

class track {
    private int $id;
    private int $albumId;
    private int $songId;
    private int $diskNumber;
    private int $number;
    private int $duration;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getDiskNumber(): int
    {
        return $this->diskNumber;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getSongId(): int
    {
        return $this->songId;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function findSongByTrackId(int $trackId): song{
        $query = MyPdo::getInstance()->prepare("SELECT id, name FROM song s join track t on s.id = t.songId WHERE t.id = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, track::class);
        $query->execute([$trackId]);
        return $query->fetch();
    }

}