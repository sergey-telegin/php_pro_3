<?php

namespace App;

class UrlDecoder implements IUrlDecoder
{
    protected Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function decode(string $code): string
    {
        return $this->repository->findUrl($code);
    }
}