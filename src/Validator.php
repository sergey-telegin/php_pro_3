<?php

namespace App;

use App\Repository;

class Validator
{
    private \App\Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function isVarUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public function isURLUnique(string $url): bool
    {
        return $this->repository->isUrlUnique($url);
    }

    public function isUrlValid(string $url)
    {

        if (!$this->isVarUrl($url)) {
            return false;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($http_code === 200) {
            return true;
        }

        return false;

    }

}
