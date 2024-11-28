<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126091156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418E0A0E041');
        $this->addSql('DROP INDEX IDX_14B78418E0A0E041 ON photo');
        $this->addSql('ALTER TABLE photo CHANGE finished_id finished_activity_id INT NOT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418E40D33AA FOREIGN KEY (finished_activity_id) REFERENCES finished_activity (id)');
        $this->addSql('CREATE INDEX IDX_14B78418E40D33AA ON photo (finished_activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418E40D33AA');
        $this->addSql('DROP INDEX IDX_14B78418E40D33AA ON photo');
        $this->addSql('ALTER TABLE photo CHANGE finished_activity_id finished_id INT NOT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418E0A0E041 FOREIGN KEY (finished_id) REFERENCES finished_activity (id)');
        $this->addSql('CREATE INDEX IDX_14B78418E0A0E041 ON photo (finished_id)');
    }
}
