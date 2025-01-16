<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128124100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `catalog` (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1B2C32475DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_province (catalog_id INT NOT NULL, provinces_id INT NOT NULL, INDEX IDX_EAD06405CC3C66FC (catalog_id), INDEX IDX_EAD06405719153BA (provinces_id), PRIMARY KEY(catalog_id, provinces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_cat VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finished_activity (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, catalog_id INT NOT NULL, name_activity VARCHAR(255) NOT NULL, date DATE NOT NULL, photo_path VARCHAR(255) DEFAULT NULL, INDEX IDX_C0907345A76ED395 (user_id), INDEX IDX_C0907345CC3C66FC (catalog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, finished_activity_id INT NOT NULL, name_photo VARCHAR(255) NOT NULL, INDEX IDX_14B78418E40D33AA (finished_activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provinces (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_surname VARCHAR(255) NOT NULL, second_surname VARCHAR(255) NOT NULL, phone INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `catalog` ADD CONSTRAINT FK_1B2C32475DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD06405CC3C66FC FOREIGN KEY (catalog_id) REFERENCES `catalog` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_province ADD CONSTRAINT FK_EAD06405719153BA FOREIGN KEY (provinces_id) REFERENCES provinces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C0907345A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C0907345CC3C66FC FOREIGN KEY (catalog_id) REFERENCES `catalog` (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418E40D33AA FOREIGN KEY (finished_activity_id) REFERENCES finished_activity (id)');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `catalog` DROP FOREIGN KEY FK_1B2C32475DC6FE57');
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD06405CC3C66FC');
        $this->addSql('ALTER TABLE activity_province DROP FOREIGN KEY FK_EAD06405719153BA');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C0907345A76ED395');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C0907345CC3C66FC');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418E40D33AA');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA44812469DE2');
        $this->addSql('DROP TABLE `catalog`');
        $this->addSql('DROP TABLE activity_province');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE finished_activity');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE provinces');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
