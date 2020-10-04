<?php


namespace App\Service;


use App\Entity\ShortUrl;
use App\Repository\ShortUrlRepository;
use Hidehalo\Nanoid\Client;

class ShortUrlService
{
    private ShortUrlRepository $repository;
    private Client $generator;

    /**
     * ShortUrlService constructor.
     * @param ShortUrlRepository $repository
     * @param Client $generator
     */
    public function __construct(ShortUrlRepository $repository, Client $generator)
    {
        $this->repository = $repository;
        $this->generator = $generator;
    }

    public function find(string $source) : ?ShortUrl {
        return $this->repository->find($source);
    }

    public function create(ShortUrl  $shortUrl, string $baseUrl) : ShortUrlResult {
        if (empty($shortUrl->getSource()))
        {
            $shortUrl->setSource($this->generator->generateId(7));
        }
        $this->repository->save($shortUrl);
        $source = $baseUrl . "/" . $shortUrl->getSource();
        return new ShortUrlResult($shortUrl->getTarget(), $source, strlen($shortUrl->getTarget()),
        strlen($source));
    }

}