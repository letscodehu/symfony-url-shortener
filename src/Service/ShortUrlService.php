<?php


namespace App\Service;


use App\Entity\ShortUrl;
use App\Repository\ShortUrlRepository;

class ShortUrlService
{
    private ShortUrlRepository $repository;

    /**
     * ShortUrlService constructor.
     * @param ShortUrlRepository $repository
     */
    public function __construct(ShortUrlRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(string $source) : ?ShortUrl {
        return $this->repository->find($source);
    }

    public function create(ShortUrl  $shortUrl, string $baseUrl) : ShortUrlResult {
        $this->repository->save($shortUrl);
        $source = $baseUrl . "/" . $shortUrl->getSource();
        return new ShortUrlResult($shortUrl->getTarget(), $source, strlen($shortUrl->getTarget()),
        strlen($source));
    }

}