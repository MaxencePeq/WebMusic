<?php

namespace Entity\Collection;

class songCollection
{
    public static function YoutubeLinkWithArtistAndSongName(string $songName, string $artistName): string{
        $baselink = 'https://www.youtube.com/results?search_query=';
        $baselink .= "{$artistName}+{$songName}";
        return $baselink;
    }
}