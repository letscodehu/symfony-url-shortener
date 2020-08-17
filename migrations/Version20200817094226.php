<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817094226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add short url table.';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("CREATE TABLE short_url (target varchar (255), source VARCHAR (16), PRIMARY KEY (source))");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DROP TABLE short_url");
    }
}
