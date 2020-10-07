<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006132839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, categorie VARCHAR(10) NOT NULL, type VARCHAR(12) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F65593E576C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, prenom VARCHAR(36) NOT NULL, nom VARCHAR(36) NOT NULL, telephone VARCHAR(10) NOT NULL, adresse VARCHAR(50) NOT NULL, ville VARCHAR(36) NOT NULL, code_postal VARCHAR(5) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E576C50E4A');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE user');
    }
}
