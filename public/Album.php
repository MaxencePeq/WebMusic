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
$webpage->appendCssUrl('http://localhost:8000/css/style.css');

$webpage->appendContent(<<<HTML
<div class="albumDetail">
    <img class="SongCover" src="Cover.php?coverId={$album->getCoverId()}" alt="Cover de l'album"/>
    <h2>{$album->getName()}</h2>
    <ol class="tracklist">
HTML);

foreach($allAlbumTrack as $track){
    $song = Song::findById($track->getSongId());
    $num = $track->getNumber();
    $songName = htmlspecialchars($song->getName());

    $webpage->appendContent(<<<HTML
        <a href="Song.php?songId={$track->getSongId()}">
        <li>{$songName}</li>
        </a>
HTML);
}

$webpage->appendContent(<<<HTML
    </ol>
</div>
HTML);


echo $webpage->toHtml();