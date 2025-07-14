<?php
declare(strict_types=1);

use Entity\cover;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

$coverId = (int)$_GET['coverId'];
$cover = Cover::findById($coverId);

header("Content-Type: image/jpeg");
echo $cover->getJpeg();
