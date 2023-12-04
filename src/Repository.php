<?php

namespace App;

class Repository
{
    protected const FILE_PATH = __DIR__ . '/../base.txt';
    protected $shortUrl;

    protected $longUrl;

    public function findUrl(string $shortUrl): ?string
    {

        if (!(file_exists(self::FILE_PATH) && is_readable(self::FILE_PATH))) {
            return null;
        }

        $content = file(self::FILE_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($content as $line) {
            [$savedShortUrl, $longUrl] = explode(' - ', $line);

            if ($shortUrl === $savedShortUrl) {

                return $longUrl;
            }
        }

        return null;
    }

    public function isUrlUnique(string $url): bool
    {
        return !$this->findUrl($url);
    }

    public function saveNewUrl(string $shortUrl, string $longUrl): bool
    {
        if (!$this->isUrlUnique($shortUrl)) {
            throw new NotUniqueShortUrlException();
        }
        $handle = fopen(self::FILE_PATH, "a+");
        fwrite($handle, $shortUrl . ' - ' . $longUrl . PHP_EOL);
        fclose($handle);
        return true;
    }

}