<?php

namespace App;

class UrlDecoder implements IUrlDecoder
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function decode(string $code): string
    {
        return $this->repository->findUrl($code);
    }
}