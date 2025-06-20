<?php
declare(strict_types=1);

use Entity\Collection;
use Entity\album;
use Entity\song;
use html\AppWebPage;

$albumId = (int)$_GET['albumId'];
$album = Album::findById($albumId);

$allAlbumTrack = Collection\albumCollection::findAllTrackByAlbumId($albumId);

$webpage = new AppWebPage();
$webpage->setTitle("{$album->getName()}");

$webpage->appendContent(<<<HTML
<div class="track">
HTML);

foreach($allAlbumTrack as $track){
    $song = Song::findById($track->getSongId());
    $num = $track->getNumber();

    $webpage->appendContent(<<<HTML
    <div class="song">
        <img class="SongCover" src="Cover.php?coverId={$album->getCoverId()}"/> 
        <a class="songtext" href="Song.php?songId={$track->getSongId()}">{$num} - {$song->getName()}</a>
    </div>
HTML);
}

$webpage->appendContent(<<<HTML
</div>
HTML);

echo $webpage->toHtml();