<?php

use App\UrlEncoder;
use App\ShortUrlGenerator;
use App\Repository;
use App\Validator;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new Repository();
$urlGenerator = new ShortUrlGenerator();
$validator = new Validator($repository);
$encoder = new UrlEncoder($validator, $repository, $urlGenerator);
$decoder = new \App\UrlDecoder($repository);

$shortUrl = $encoder->encode('https://lingomost.com/gramm/nachalo/');

$longUrl = $decoder->decode($shortUrl);

var_dump($shortUrl);
echo PHP_EOL;

echo PHP_EOL;
var_dump($longUrl);