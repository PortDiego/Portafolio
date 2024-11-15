<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241030105332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A3397707A');
        $this->addSql('DROP INDEX IDX_AC74095A3397707A ON activity');
        $this->addSql('ALTER TABLE activity DROP categoria_id');
        $this->addSql('ALTER TABLE category DROP nombre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity ADD categoria_id INT NOT NULL');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A3397707A FOREIGN KEY (categoria_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_AC74095A3397707A ON activity (categoria_id)');
        $this->addSql('ALTER TABLE category ADD nombre VARCHAR(255) NOT NULL');
    }
}
