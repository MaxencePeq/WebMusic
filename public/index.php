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
<div class="sorting">

    <form method="post" >
        <div class="sortingByName">
            <input type="hidden" name="Change_Order" value="1">
            <input type="submit" name="order" value="Trier par nom">
        </div>
    </form>
    
    <form method="post" >
        <div class="sortingByPopularity">
            <input type="hidden" name="Change_Order" value="1">
            <input type="submit" name="order" value="Trier par popularité">
        </div>
    </form>

HTML);


$webpage->appendContent(<<<HTML
</div>
HTML);



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
    <a href="Genre.php?genreId={$genreId}">
        <h3>{$name}</h3>
        <p>exemple :</p>
        {$artistLink}
    </a>
</div>
HTML);

}

$webpage->appendContent(<<<HTML
</div>
HTML);

echo $webpage->toHtml();