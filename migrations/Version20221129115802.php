<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129115802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_individuel ADD produit_credit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_individuel ADD CONSTRAINT FK_108782AD4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('CREATE INDEX IDX_108782AD4A917115 ON credit_individuel (produit_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_individuel DROP FOREIGN KEY FK_108782AD4A917115');
        $this->addSql('DROP INDEX IDX_108782AD4A917115 ON credit_individuel');
        $this->addSql('ALTER TABLE credit_individuel DROP produit_credit_id');
    }
}
