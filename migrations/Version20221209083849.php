<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209083849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garantie_credit ADD produit_credit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garantie_credit ADD CONSTRAINT FK_9B3499164A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('CREATE INDEX IDX_9B3499164A917115 ON garantie_credit (produit_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garantie_credit DROP FOREIGN KEY FK_9B3499164A917115');
        $this->addSql('DROP INDEX IDX_9B3499164A917115 ON garantie_credit');
        $this->addSql('ALTER TABLE garantie_credit DROP produit_credit_id');
    }
}
