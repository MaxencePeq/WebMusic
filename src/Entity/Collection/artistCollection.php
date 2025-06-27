<?php

namespace Entity\Collection;

use Entity\artist;

class artistCollection
{
    public static function getInterviewFromArtist(int $artistId){
        $TheArtist = artist::findById($artistId);
        $artistName = $TheArtist->getName();

        $baselink = 'https://www.youtube.com/results?search_query=';
        $baselink .= "{$artistName}+Interview";
        return $baselink;
    }
}