<?php
declare(strict_types=1);

use Entity\Collection;
use Entity\genre;
use html\WebPage;
use Database\MyPdo;

$webpage = new \html\AppWebPage();
$webpage->setTitle('Genre musical');

$genre = Collection\genreCollection::findAll();

$webpage->appendContent(<<<HTML
<div class="box">
HTML);

foreach ($genre as $g) {
    $name = $g->getName();

    $webpage->appendContent(<<<HTML
        <div class="genre">
            <a href="Genre.php?genreId={$g->getId()}">{$name}</a>
        </div>
HTML);
}

$webpage->appendContent(<<<HTML
</div>
HTML);

echo $webpage->toHtml();