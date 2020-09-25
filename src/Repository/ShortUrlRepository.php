<?php


namespace App\Repository;


use App\Entity\ShortUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ShortUrlRepository
 * @method ShortUrl|null find($id, $lockMode = null, $lockVersion = null)
 */
class ShortUrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShortUrl::class);
    }

    public function save(ShortUrl $shortUrl) : void {
        $this->_em->persist($shortUrl);
        $this->_em->flush();
    }
}