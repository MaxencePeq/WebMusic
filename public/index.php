<?php
declare(strict_types=1);

use Entity\Collection;
use Entity\genre;
use html\WebPage;
use Database\MyPdo;

$webpage = new \html\AppWebPage();
$webpage->setTitle('Genre musical');
$webpage->appendCssUrl('http://localhost:8000/css/style.css');

$genre = Collection\genreCollection::findAll();

$webpage->appendContent(<<<HTML
<div class="box">
HTML);

foreach ($genre as $g) {
    $name = $g->getName();
    $genreId = $g->getId();
    $mostPopularArtist = Entity\Collection\genreCollection::findMostPopularArtistByGenreId($genreId);
    $exemple = $mostPopularArtist ? $mostPopularArtist->getName() : "Aucun artiste trouvé";


    if ($mostPopularArtist) {
        $artistId = $mostPopularArtist->getId();
        $artistLink = "<a href=\"Artist.php?artistId={$artistId}\">{$exemple}</a>";
    } else {
        $artistLink = "<p>{$exemple}</p>";
    }

    $webpage->appendContent(<<<HTML
    <div class="genre">
        <a href="Genre.php?genreId={$genreId}"> <h3>{$name}</h3></a>
        <p>exemple :</p>
        {$artistLink}
    </div>
HTML);


}

$webpage->appendContent(<<<HTML
</div>
HTML);

echo $webpage->toHtml();