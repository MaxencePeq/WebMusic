<?php
declare(strict_types=1);

use Entity\Collection;
use html\webpage;
use Database\MyPdo;

$webpage = new \html\searchappwebpage();
$webpage->setTitle('Résultats de recherche');
$webpage->appendCssUrl('http://localhost:8000/css/style.css');

// Traitement de la soumission du formulaire
$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'], $_POST['search_type'])) {
    $searchTerm = $_POST['search'];
    $searchType = $_POST['search_type'];

    if ($searchType === 'song') {
        $searchResults = \Entity\Collection\editCollection::searchbarSong($searchTerm);
    } elseif ($searchType === 'artist') {
        $searchResults = \Entity\Collection\editCollection::searchbarArtist($searchTerm);
    }
}

$webpage->appendContent(<<<HTML
<div class="sorting">
    <form method="post">
    <div class="sortingBySongName">
        <input type="hidden" name="search_type" value="song">
        <input type="text" name="search" placeholder="Tapez un titre de musique..." required>
        <input type="submit" value="Rechercher">
    </div>
</form>

<form method="post">
    <div class="sortingByArtistName">
        <input type="hidden" name="search_type" value="artist">
        <input type="text" name="search" placeholder="Tapez un nom d'artiste..." required>
        <input type="submit" value="Rechercher">
    </div>
</form>

</div>
HTML);

$webpage->appendContent("<div class=box>");

if (count($searchResults) === 0) {
    $webpage->appendContent("<p>Aucun résultat trouvé.</p>");
} else {
    if ($searchType === 'song') {
        foreach ($searchResults as $result) {
            $webpage->appendContent(<<<HTML
<a href="Song.php?songId={$result['songId']}">
    <div class="result">
        <h3>{$result['songName']}</h3>
        <p>Artiste : {$result['artistName']}</p>
        <p>Album : {$result['albumName']}</p>
        <p>Genre : {$result['genreName']}</p>
    </div>
</a>
HTML);
        }
    } elseif ($searchType === 'artist') {
        foreach ($searchResults as $result) {
            $artistId = $result['artistId'];
            $webpage->appendContent(<<<HTML
    <a href="Artist.php?artistId={$artistId}" class="result">
        <h3>Artiste : {$result['artistName']}</h3>
     </a>
HTML);
        }
    }
}


$webpage->appendContent(<<<HTML
</div>
</div>
HTML);

echo $webpage->toHtml();
