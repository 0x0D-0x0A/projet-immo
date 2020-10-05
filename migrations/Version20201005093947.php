<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005093947 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E56EC1D6E1');
        $this->addSql('DROP INDEX IDX_F65593E56EC1D6E1 ON annonce');
        $this->addSql('ALTER TABLE annonce CHANGE proprietaire_id_id proprietaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E576C50E4A ON annonce (proprietaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E576C50E4A');
        $this->addSql('DROP INDEX IDX_F65593E576C50E4A ON annonce');
        $this->addSql('ALTER TABLE annonce CHANGE proprietaire_id proprietaire_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E56EC1D6E1 FOREIGN KEY (proprietaire_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E56EC1D6E1 ON annonce (proprietaire_id_id)');
    }
}
