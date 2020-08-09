<?php


namespace App\Repository;


use Doctrine\DBAL\Connection;

class ShortUrlRepository
{
    private Connection $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}