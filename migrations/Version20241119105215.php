<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119105215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS`activityBBDD` (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B9B19EF45DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS activity_province (activity_bbdd_id INT NOT NULL, provinces_id INT NOT NULL, INDEX IDX_EAD0640585DDF7F8 (activity_bbdd_id), INDEX IDX_EAD06405719153BA (provinces_id), PRIMARY KEY(activity_bbdd_id, provinces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS provinces (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `activityBBDD` ADD CONSTRAINT FK_B9B19EF45DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD0640585DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES `activityBBDD` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD06405719153BA FOREIGN KEY (provinces_id) REFERENCES provinces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity ADD activity_bbdd_id INT NOT NULL');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A85DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES `activityBBDD` (id)');
        $this->addSql('CREATE INDEX IDX_AC74095A85DDF7F8 ON activity (activity_bbdd_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A85DDF7F8');
        $this->addSql('ALTER TABLE `activityBBDD` DROP FOREIGN KEY FK_B9B19EF45DC6FE57');
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD0640585DDF7F8');
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD06405719153BA');
        $this->addSql('DROP TABLE `activityBBDD`');
        $this->addSql('DROP TABLE activity_province');
        $this->addSql('DROP TABLE provinces');
        $this->addSql('DROP INDEX IDX_AC74095A85DDF7F8 ON activity');
        $this->addSql('ALTER TABLE activity DROP activity_bbdd_id');
    }
}
