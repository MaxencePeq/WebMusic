<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\track;

class editCollection
{
    /**
     * retourne un song, artist, genre ou album en fonction de ce qui est cherché
     * dans la searchbar (mis en parametre dans le cas de notre fonction)
     *
     * La fonction crée un pré-like dans la requete SQL qui ce rempli avec la str
     * mis en parametre
     * @param string $search
     * @return mixed
     */
    public static function searchbarSong(string $search): array {
        $query = MyPdo::getInstance()->prepare(<<<SQL
        SELECT 
            song.id AS songId,
            song.name AS songName,
            artist.name AS artistName,
            album.name AS albumName,
            genre.name AS genreName
        FROM track
        JOIN song ON track.songId = song.id
        JOIN album ON track.albumId = album.id
        JOIN artist ON album.artistId = artist.id
        JOIN genre ON album.genreId = genre.id
        WHERE song.name LIKE :search
    SQL);

        $query->execute(['search' => "%$search%"]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function searchbarArtist(string $search): array {
        $query = MyPdo::getInstance()->prepare(<<<SQL
SELECT DISTINCT 
    artist.id AS artistId,
    artist.name AS artistName
FROM artist
WHERE artist.name LIKE :search
SQL);

        $query->execute(['search' => "%$search%"]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }






}