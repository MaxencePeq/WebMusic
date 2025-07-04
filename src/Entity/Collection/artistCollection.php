<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\artist;
use Entity\genre;
use PDO;

class artistCollection
{
    public static function getInterviewFromArtist(int $artistId){
        $TheArtist = artist::findById($artistId);
        $artistName = $TheArtist->getName();

        $baselink = 'https://www.youtube.com/results?search_query=';
        $baselink .= "{$artistName}+Interview";
        return $baselink;
    }

    public static function findIdByName(string $artist_name){
        $query = MyPdo::getInstance()->prepare("SELECT artist.id FROM artists WHERE name = :name");
        $query->bindParam(':name', $artist_name);
        $query->setFetchMode(PDO::FETCH_CLASS, artist::class);
        $query->execute();
        return $query->fetch();
    }

}