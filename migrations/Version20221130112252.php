<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130112252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_credit ADD produit_credit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('CREATE INDEX IDX_5E8528114A917115 ON demande_credit (produit_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528114A917115');
        $this->addSql('DROP INDEX IDX_5E8528114A917115 ON demande_credit');
        $this->addSql('ALTER TABLE demande_credit DROP produit_credit_id');
    }
}
