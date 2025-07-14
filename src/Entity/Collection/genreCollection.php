<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\artist;
use Entity\genre;
use PDO;

class genreCollection
{

    /**
     * Renvoi tous les genres en fonction des boutons de tri
     * @return genre[]
     */
    public static function findAll():array
    {

        $query = MyPdo::getInstance()->prepare(<<<SQL
        SELECT id, name
        FROM genre
        ORDER BY name
        SQL);


        if (isset($_POST['Change_Order']) && isset($_POST['order'])) {

            if ($_POST['order'] === 'Trier par nom') {

                $query = MyPdo::getInstance()->prepare(<<<SQL
        SELECT id, name
        FROM genre
        ORDER BY name
        SQL);

            } else if ($_POST['order'] === 'Trier par popularité') {

                $query = MyPdo::getInstance()->prepare(<<<SQL
        SELECT genre.id, genre.name, COUNT(DISTINCT album.artistId)
        FROM genre
        JOIN album ON genre.id = album.genreId
        GROUP BY genre.id, genre.name
        ORDER BY COUNT(DISTINCT album.artistId) DESC;

        SQL);
            }
        }

        $query->setFetchMode(PDO::FETCH_CLASS, genre::class);
        $query->execute();
        return $query->fetchAll();

    }

    /**
     * Renvoie tous les artist(s) qui ont fait au moins un album du genre {$genreId}
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

    /**
     * Renvois le nom de l'artist ayant le plus d'album, depuis l'id du genre
     * @param int $genreID
     * @return artist
     */
    public static function findMostPopularArtistByGenreId(int $genreID) {
        $query = MyPdo::getInstance()->prepare(<<<SQL
        SELECT artist.*
        FROM artist
        JOIN album ON artist.id = album.artistId
        WHERE album.genreId = ?
        GROUP BY artist.id
        ORDER BY COUNT(album.id) DESC
        LIMIT 1
    SQL);

        $query->setFetchMode(PDO::FETCH_CLASS, artist::class);
        $query->execute([$genreID]);
        return $query->fetch();
    }



}