<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\album;
use Entity\artist;
use Entity\track;

class albumCollection {

    /**
     * Retourne le genre d'un album
     * @param int $albumId
     * @return genre
     */
    public static function findAlbumGenreByAlbumId(int $albumId):genre{
        $query = MyPdo::getInstance()->prepare("SELECT g.id,g.name FROM album join genre g on album.genreId = g.id WHERE id = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, genre::class);
        $query->execute([$albumId]);
        return $query->fetch();
    }


    /**
     * Renvoie l'artist ayant produis l'album (albumId)
     * @param int $albumId
     * @return artist
     */
    public static function findArtistByAlbumId(int $albumId):artist{
        $query = MyPdo::getInstance()->prepare("SELECT id, name FROM album join artist a on album.artistId = a.id WHERE id = ?");
        $query->setFetchMode(\PDO::FETCH_CLASS, artist::class);
        $query->execute([$albumId]);
        return $query->fetch();
    }


    /**
     * Renvoie tous les track d'un album depuis son ID
     * @param int $albumId
     * @return track[]
     */
    public static function findAllTrackByAlbumId(int $albumId):array{
        $query = MyPdo::getInstance()->prepare("SELECT t.id, t.albumId, t.songId, t.diskNumber, t.number, t.duration 
                                                       from album join track t on album.id = t.albumId 
                                                       where album.id = ?
                                                       ORDER BY t.number");
        $query->setFetchMode(\PDO::FETCH_CLASS, track::class);
        $query->execute([$albumId]);
        return $query->fetchAll();

    }




}