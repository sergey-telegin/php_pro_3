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
        if (!$this->validator->isUrlValid($url)) {
            throw new \InvalidArgumentException();
        }

        do {
            $shortUrl = $this->generator->generationShortUrl();
            try {
                $this->repository->saveNewUrl($shortUrl, $url);
                $success = true;
            } catch (NotUniqueShortUrlException) {
                $success = false;
            }
        } while (!$success);

        return $shortUrl;

    }
}