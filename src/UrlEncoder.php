<?php

namespace App;

class UrlEncoder implements IUrlEncoder
{

    private Validator $validator;
    private Repository $repository;
    private ShortUrlGenerator $generator;

    public function __construct(Validator $validator, Repository $repository, ShortUrlGenerator $generator)
    {

        $this->validator = $validator;
        $this->repository = $repository;
        $this->generator = $generator;
    }

    public function encode(string $url): string
    {
        if (!$this->validator->isVarUrl($url)) {
            throw new \InvalidArgumentException();
        }
        $shortUrl = $this->generator->generationShortUrl();

        if (!$this->validator->isVarUnique($shortUrl)) {
            throw new \InvalidArgumentException();
        }

        $isSavedUrl = $this->repository->saveNewUrl($shortUrl, $url);

        if (!$isSavedUrl){
            throw new \InvalidArgumentException();
        }

        return $shortUrl;

    }
}