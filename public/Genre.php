<?php
declare(strict_types=1);

use Entity\Collection;
use Entity\artist;
use Entity\genre;
use html\WebPage;

$genreID = (int)$_GET['genreId'];
$genre = genre::findByGenreId($genreID);

$webpage = new \html\AppWebPage();
$webpage->setTitle('Liste des artistes de ' . $genre->getName());

/* $artist = array */
$artist = Collection\genreCollection::findArtistByGenreId($genreID);

$webpage->appendContent(<<<HTML
<div class="box">
HTML);

foreach ($artist as $a) {
    $name = $a->getName();

    $webpage->appendContent(<<<HTML
        <div class="artist">
            <a href="Artist.php?artistId={$a->getId()}">{$name}</a>
        </div>
HTML);
}

$webpage->appendContent(<<<HTML
</div>
HTML);

echo $webpage->toHtml();
