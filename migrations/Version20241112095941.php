<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112095941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity CHANGE fecha date DATE NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE nombre_cat name_cat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE subcategory CHANGE nombre name_sub VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD first_surname VARCHAR(255) NOT NULL, ADD second_surname VARCHAR(255) NOT NULL, DROP nombre, DROP apellido1, DROP apellido2, CHANGE telefono phone INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity CHANGE date fecha DATE NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name_cat nombre_cat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE subcategory CHANGE name_sub nombre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `user` ADD nombre VARCHAR(255) NOT NULL, ADD apellido1 VARCHAR(255) NOT NULL, ADD apellido2 VARCHAR(255) NOT NULL, DROP name, DROP first_surname, DROP second_surname, CHANGE phone telefono INT NOT NULL');
    }
}
