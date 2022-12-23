<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221223125500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approbation_credit ADD CONSTRAINT FK_20B777323952A9BD FOREIGN KEY (agent_credit_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_20B777323952A9BD ON approbation_credit (agent_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approbation_credit DROP FOREIGN KEY FK_20B777323952A9BD');
        $this->addSql('DROP INDEX IDX_20B777323952A9BD ON approbation_credit');
    }
}
