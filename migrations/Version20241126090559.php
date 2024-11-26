<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126090559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD finished_id INT NOT NULL, ADD name_photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418E0A0E041 FOREIGN KEY (finished_id) REFERENCES finished_activity (id)');
        $this->addSql('CREATE INDEX IDX_14B78418E0A0E041 ON photo (finished_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418E0A0E041');
        $this->addSql('DROP INDEX IDX_14B78418E0A0E041 ON photo');
        $this->addSql('ALTER TABLE photo DROP finished_id, DROP name_photo');
    }
}
