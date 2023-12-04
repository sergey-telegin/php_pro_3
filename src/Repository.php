<?php

namespace App;

class Repository
{
    protected $shortUrl;

    protected $longUrl;

    public function findUrl(string $shortUrl): ?string
    {

        $base = __DIR__ . '/../base.txt';

        if (file_exists($base) && is_readable($base)) {

            $lines = file($base, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                [$savedShortUrl, $longUrl] = explode(' - ', $line);

                if ($shortUrl === $savedShortUrl) {

                    return $longUrl;
                }
            }
        }

        return null;
    }

    public function saveNewUrl(string $shortUrl, string $longUrl): bool
    {
        $base = __DIR__ . '/../base.txt';
        $isVarUnique = new Validator();
        if ($isVarUnique->isVarUnique($shortUrl) === true) {
            $handle = fopen("base.txt", "a+");
            fwrite($handle, $shortUrl . ' - ' . $longUrl . PHP_EOL);
            fclose($handle);
            return true;
        } else {
            return false;
        }
    }



}