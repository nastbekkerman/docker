<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023075610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE otel ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE otel ADD CONSTRAINT FK_4D774A548BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_4D774A548BAC62AF ON otel (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE otel DROP FOREIGN KEY FK_4D774A548BAC62AF');
        $this->addSql('DROP INDEX IDX_4D774A548BAC62AF ON otel');
        $this->addSql('ALTER TABLE otel DROP city_id');
    }
}
