<?php

namespace Entity;
use Database\MyPdo;
use PDO;


class genre
{
    private int $id;
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Renvoie un genre depuis son ID
     * @param int $genreId
     * @return genre
     */
    public static function findByGenreId(int $genreId): genre{
        $query = MyPdo::getInstance()->prepare("SELECT * FROM genre WHERE id = ?");
        $query->setFetchMode(PDO::FETCH_CLASS, genre::class);
        $query->execute([$genreId]);
        return $query->fetch();
    }



}