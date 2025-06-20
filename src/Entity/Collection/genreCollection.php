<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\artist;
use Entity\genre;
use PDO;

class genreCollection
{

    /**
     * Renvoi tous les genres
     * @return genre[]
     */
    public static function findAll():array
    {
        $query = MyPdo::getInstance()->prepare(<<<SQL
        SELECT id, name
        FROM genre
        ORDER BY name
        SQL);

        $query->setFetchMode(PDO::FETCH_CLASS, genre::class);
        $query->execute();
        return $query->fetchAll();

    }

    /**
     * Renvoie tout les artist(s) qui on fait au moins un album du genre {$genreId}
     * @param int $genreID
     * @return artist[]
     */
    public static function findArtistByGenreId(int $genreID):array{
        $query = MyPdo::getInstance()->prepare(<<<SQL
    SELECT DISTINCT a.id, a.name
    FROM artist a
    JOIN album alb ON a.id = alb.artistId
    WHERE alb.genreId = ?
    ORDER BY a.name
SQL);
        $query->setFetchMode(PDO::FETCH_CLASS, artist::class);
        $query->execute([$genreID]);
        return $query->fetchAll();

    }


}