<?php
declare(strict_types=1);

use Entity\album;
use Entity\artist;
use Entity\Collection;
use Entity\song;
use html\AppWebPage;

$songId = (int)$_GET['songId'];
$song = song::findById($songId);
$songName = $song->getName();

$track = song::findTrackBySongId($songId);
$SongDuractionInminutes = intdiv($track->getDuration(), 60);
$SongDuractionInSeconde = $track->getDuration() % 60;

$album = Album::findById($track->getAlbumId());
$artist  = Artist::findById($album->getArtistId());
$artistName = $artist->getName();

$link = Collection\songCollection::YoutubeLinkWithArtistAndSongName($artistName, $songName);

$webpage = new AppWebPage();
$webpage->setTitle($song->getName());
$webpage->appendCssUrl('http://localhost:8000/css/style.css');


$webpage->appendContent(<<<HTML
<div class="songDetail">
    <div class="statsSongPoster"> 
        <img class="SongCover" src="Cover.php?coverId={$album->getCoverId()}" alt="cover image"/> 
    </div>
    <div class="stats">
        <h3>Numéro dans l'album : {$track->getNumber()}</h3>
        <h3>Durée du titre : {$SongDuractionInminutes} mins, {$SongDuractionInSeconde} sec</h3>
        
        <a href="{$link}"> 
        <h3>Lien Youtube</h3>
        </a>
    
    </div>
</div>
HTML);



$webpage->appendContent(<<<HTML
    </div>
</div>
HTML);

echo $webpage->toHtml();