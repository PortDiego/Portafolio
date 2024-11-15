<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114174344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `activityBBDD` (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, INDEX IDX_B9B19EF45DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_province (activity_bbdd_id INT NOT NULL, provinces_id INT NOT NULL, INDEX IDX_EAD0640585DDF7F8 (activity_bbdd_id), INDEX IDX_EAD06405719153BA (provinces_id), PRIMARY KEY(activity_bbdd_id, provinces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finished_activity (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, activity_bbdd_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_C0907345A76ED395 (user_id), INDEX IDX_C090734585DDF7F8 (activity_bbdd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provinces (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `activityBBDD` ADD CONSTRAINT FK_B9B19EF45DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD0640585DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES `activityBBDD` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD06405719153BA FOREIGN KEY (provinces_id) REFERENCES provinces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C0907345A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C090734585DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES `activityBBDD` (id)');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A5DC6FE57');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AA76ED395');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('DROP TABLE activity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, user_id INT NOT NULL, category_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_AC74095A12469DE2 (category_id), INDEX IDX_AC74095A5DC6FE57 (subcategory_id), INDEX IDX_AC74095AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE `activityBBDD` DROP FOREIGN KEY FK_B9B19EF45DC6FE57');
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD0640585DDF7F8');
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD06405719153BA');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C0907345A76ED395');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C090734585DDF7F8');
        $this->addSql('DROP TABLE `activityBBDD`');
        $this->addSql('DROP TABLE activity_province');
        $this->addSql('DROP TABLE finished_activity');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE provinces');
    }
}
