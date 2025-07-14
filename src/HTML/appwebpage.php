<?php
declare(strict_types=1);

namespace html;

class appwebpage extends webpage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title = "");
    }

    public function toHTML(): string
    {
        return $htmlBody = <<<HTML
        <!doctype html>
        <head>
            <meta charset='UTF-8'>
            <title>
            {$this->escapeString($this->getTitle())}
            </title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no\">
            {$this->getHead()}
        </head>
        <body>  
             <div class="header">
                <a class="IndexButton" href="http://localhost:8000">
                    <button type="button">Retour index</button>
                </a>
                <div class="headerTitle">
                <h1>{$this->escapeString($this->getTitle())}</h1>
                </div>
                <a class="editButton" href="http://localhost:8000/search.php">
                    <button type="button">Rechercher</button>
                </a>
             </div>
             
             <div class="content">
                {$this->getBody()}
            </div>
        
            <div class="footer">
                <p>{$this->getLastModification()}</p>
            </div>
            
        </div>
        </body>
HTML;
    }
}