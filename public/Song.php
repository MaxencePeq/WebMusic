<?php
declare(strict_types=1);

use Entity\album;
use Entity\Collection;
use Entity\song;
use html\AppWebPage;

$songId = (int)$_GET['songId'];
$song = song::findById($songId);

$track = song::findTrackBySongId($songId);
$SongDuractionInminutes = intdiv($track->getDuration(), 60);
$SongDuractionInSeconde = $track->getDuration() % 60;

$album = Album::findById($track->getAlbumId());

$webpage = new AppWebPage();
$webpage->setTitle($song->getName());


$webpage->appendContent(<<<HTML
<div class="box">
    <div class="statsSongPoster"> <img class="SongCover" src="Cover.php?coverId={$album->getCoverId()}"/> </div>
    <div class="stats">
        <h3> Numéro dans l'album : {$track->getNumber()}<h3>
        <h3> Durée du titre : {$SongDuractionInminutes} mins, {$SongDuractionInSeconde} sec<h3>
        
HTML);


$webpage->appendContent(<<<HTML
    </div>
</div>
HTML);

echo $webpage->toHtml();