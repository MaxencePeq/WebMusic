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
$webpage->appendCssUrl('http://localhost:8000/css/style.css');

$name = $artist->getName();
$webpage->setTitle($name);

$link = Collection\artistCollection::getInterviewFromArtist($artistId);

$webpage->appendContent(<<<HTML
<div class="page">
    <div class="info">
        <a href="{$link}">
            <h2>Lien vers des interviews de {$name}</h2>
        </a>
    </div>
HTML);

$webpage->appendContent(<<<HTML
<div class="albumBox">
HTML);

foreach ($artistAlbum as $album) {
    $name = $album->getName();
    $webpage->appendContent(<<<HTML
<a href="Album.php?albumId={$album->getId()}">
    <div class="artistAlbum">
        <img src="Cover.php?coverId={$album->getCoverId()}" /> 
        {$name}
    </div>
</a>    

HTML);
}


$webpage->appendContent(<<<HTML
    </div>
</div>
HTML);

echo $webpage->toHtml();