<?php
declare(strict_types=1);

use Entity\Collection;
use Entity\artist;
use Entity\genre;
use html\AppWebPage;

$artistId = (int)$_GET['artistId'];
$artist = artist::FindArtistByArtistId($artistId);
$artistAlbum = artist::getAllAlbum($artistId);

$webpage = new AppWebPage();

$name = $artist->getName();
$webpage->setTitle($name);

$webpage->appendContent(<<<HTML
<div class="page">
HTML);

/* Boucle style */

$webpage->appendContent(<<<HTML
<div class="albumBox">
HTML);

foreach ($artistAlbum as $album) {
    $name = $album->getName();
    $webpage->appendContent(<<<HTML
    <img src="Cover.php?coverId={$album->getCoverId()}"/> 
    <a href="Album.php?albumId={$album->getId()}">{$name}</a>
HTML);
}


$webpage->appendContent(<<<HTML
    </div>
</div>
HTML);

echo $webpage->toHtml();