<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class cover {
    private int $id;
    private string $jpeg;

    public function getId(): int
    {
        return $this->id;
    }

    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function FindById(int $coverId): Cover{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM cover WHERE id = ?");
        $query->setFetchMode(PDO::FETCH_CLASS, Cover::class);
        $query->execute([$coverId]);
        return $query->fetch();
    }

}