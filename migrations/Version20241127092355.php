<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127092355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE finished_activity (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, activity_bbdd_id INT NOT NULL, name_activity VARCHAR(255) NOT NULL, date DATE NOT NULL, photo_path VARCHAR(255) DEFAULT NULL, INDEX IDX_C0907345A76ED395 (user_id), INDEX IDX_C090734585DDF7F8 (activity_bbdd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, finished_activity_id INT NOT NULL, name_photo VARCHAR(255) NOT NULL, INDEX IDX_14B78418E40D33AA (finished_activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C0907345A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE finished_activity ADD CONSTRAINT FK_C090734585DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES `activityBBDD` (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418E40D33AA FOREIGN KEY (finished_activity_id) REFERENCES finished_activity (id)');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AA76ED395');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A5DC6FE57');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A85DDF7F8');
        $this->addSql('ALTER TABLE imagen_activity DROP FOREIGN KEY FK_DD077E6881C06096');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE imagen_activity');
        $this->addSql('ALTER TABLE user ADD first_surname VARCHAR(255) NOT NULL, ADD second_surname VARCHAR(255) NOT NULL, DROP lastname1, DROP lastname2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subcategory_id INT NOT NULL, category_id INT NOT NULL, activity_bbdd_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_AC74095A85DDF7F8 (activity_bbdd_id), INDEX IDX_AC74095AA76ED395 (user_id), INDEX IDX_AC74095A5DC6FE57 (subcategory_id), INDEX IDX_AC74095A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE imagen_activity (id INT AUTO_INCREMENT NOT NULL, activity_id INT NOT NULL, url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DD077E6881C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A85DDF7F8 FOREIGN KEY (activity_bbdd_id) REFERENCES activitybbdd (id)');
        $this->addSql('ALTER TABLE imagen_activity ADD CONSTRAINT FK_DD077E6881C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C0907345A76ED395');
        $this->addSql('ALTER TABLE finished_activity DROP FOREIGN KEY FK_C090734585DDF7F8');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418E40D33AA');
        $this->addSql('DROP TABLE finished_activity');
        $this->addSql('DROP TABLE photo');
        $this->addSql('ALTER TABLE `user` ADD lastname1 VARCHAR(255) NOT NULL, ADD lastname2 VARCHAR(255) NOT NULL, DROP first_surname, DROP second_surname');
    }
}
