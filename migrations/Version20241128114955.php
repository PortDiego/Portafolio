<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128114955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD0640585DDF7F8');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C090734585DDF7F8');
        $this->addSql('CREATE TABLE `catalog` (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1B2C32475DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `catalog` ADD CONSTRAINT FK_1B2C32475DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE activitybbdd DROP FOREIGN KEY FK_B9B19EF45DC6FE57');
        $this->addSql('DROP TABLE activitybbdd');
        $this->addSql('DROP INDEX IDX_EAD0640585DDF7F8 ON activity_province');
        $this->addSql('DROP INDEX `primary` ON activity_province');
        $this->addSql('ALTER TABLE activity_province CHANGE activity_bbdd_id catalog_id INT NOT NULL');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD06405CC3C66FC FOREIGN KEY (catalog_id) REFERENCES `catalog` (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EAD06405CC3C66FC ON activity_province (catalog_id)');
        $this->addSql('ALTER TABLE activity_province ADD PRIMARY KEY (catalog_id, provinces_id)');
        $this->addSql('DROP INDEX IDX_C090734585DDF7F8 ON finished_activity');
        $this->addSql('ALTER TABLE finished_activity CHANGE activity_bbdd_id catalog_id INT NOT NULL');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C0907345CC3C66FC FOREIGN KEY (catalog_id) REFERENCES `catalog` (id)');
        $this->addSql('CREATE INDEX IDX_C0907345CC3C66FC ON finished_activity (catalog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD06405CC3C66FC');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C0907345CC3C66FC');
        $this->addSql('CREATE TABLE activitybbdd (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_B9B19EF45DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activitybbdd ADD CONSTRAINT FK_B9B19EF45DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE `catalog` DROP FOREIGN KEY FK_1B2C32475DC6FE57');
        $this->addSql('DROP TABLE `catalog`');
        $this->addSql('DROP INDEX IDX_EAD06405CC3C66FC ON activity_province');
        $this->addSql('DROP INDEX `PRIMARY` ON activity_province');
        $this->addSql('ALTER TABLE activity_province CHANGE catalog_id activity_bbdd_id INT NOT NULL');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD0640585DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES activitybbdd (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EAD0640585DDF7F8 ON activity_province (activity_bbdd_id)');
        $this->addSql('ALTER TABLE activity_province ADD PRIMARY KEY (activity_bbdd_id, provinces_id)');
        $this->addSql('DROP INDEX IDX_C0907345CC3C66FC ON finished_activity');
        $this->addSql('ALTER TABLE finished_activity CHANGE catalog_id activity_bbdd_id INT NOT NULL');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C090734585DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES activitybbdd (id)');
        $this->addSql('CREATE INDEX IDX_C090734585DDF7F8 ON finished_activity (activity_bbdd_id)');
    }
}
