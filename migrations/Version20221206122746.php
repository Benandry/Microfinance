<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206122746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approbation_credit DROP FOREIGN KEY FK_20B7773280E95E18');
        $this->addSql('DROP INDEX IDX_20B7773280E95E18 ON approbation_credit');
        $this->addSql('ALTER TABLE approbation_credit DROP demande_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approbation_credit ADD demande_id INT NOT NULL');
        $this->addSql('ALTER TABLE approbation_credit ADD CONSTRAINT FK_20B7773280E95E18 FOREIGN KEY (demande_id) REFERENCES demande_credit (id)');
        $this->addSql('CREATE INDEX IDX_20B7773280E95E18 ON approbation_credit (demande_id)');
    }
}
