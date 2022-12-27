<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221226112840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remboursement ADD periode INT NOT NULL, ADD date_remborsement DATE NOT NULL, ADD principale DOUBLE PRECISION NOT NULL, ADD interet DOUBLE PRECISION NOT NULL, ADD montantt_total DOUBLE PRECISION DEFAULT NULL, ADD codeclient VARCHAR(255) NOT NULL, ADD remboursement DOUBLE PRECISION DEFAULT NULL, ADD annuite DOUBLE PRECISION DEFAULT NULL, ADD penalite DOUBLE PRECISION DEFAULT NULL, ADD commission DOUBLE PRECISION DEFAULT NULL, ADD codecredit VARCHAR(255) NOT NULL, ADD typeamortissement VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remboursement DROP periode, DROP date_remborsement, DROP principale, DROP interet, DROP montantt_total, DROP codeclient, DROP remboursement, DROP annuite, DROP penalite, DROP commission, DROP codecredit, DROP typeamortissement');
    }
}
