<?php

namespace App;

use App\Repository;

class Validator
{
    protected $url;

    public function isVarUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public function isVarUnique(string $url): bool
    {
        $isVarUnique = new Repository();

        if (!$isVarUnique->findUrl($url)) {
            return true;
        } else {
            return false;
        }

    }
}