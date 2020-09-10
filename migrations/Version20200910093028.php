<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200910093028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__short_url AS SELECT source, target FROM short_url');
        $this->addSql('DROP TABLE short_url');
        $this->addSql('CREATE TABLE short_url (source VARCHAR(36) NOT NULL, target VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(source))');
        $this->addSql('INSERT INTO short_url (source, target) SELECT source, target FROM __temp__short_url');
        $this->addSql('DROP TABLE __temp__short_url');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__short_url AS SELECT source, target FROM short_url');
        $this->addSql('DROP TABLE short_url');
        $this->addSql('CREATE TABLE short_url (source VARCHAR(16) NOT NULL COLLATE BINARY, target VARCHAR(255) NOT NULL, PRIMARY KEY(source))');
        $this->addSql('INSERT INTO short_url (source, target) SELECT source, target FROM __temp__short_url');
        $this->addSql('DROP TABLE __temp__short_url');
    }
}
