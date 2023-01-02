<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102075900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE remboursement_credit');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('CREATE INDEX IDX_9B96C69FD725330D ON individuelclient (agence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE remboursement_credit (id INT AUTO_INCREMENT NOT NULL, tranche INT NOT NULL, date_paiement DATE NOT NULL, principal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, interet DOUBLE PRECISION NOT NULL, commission DOUBLE PRECISION NOT NULL, penalite DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, montant_paye DOUBLE PRECISION NOT NULL, solde_restant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FD725330D');
        $this->addSql('DROP INDEX IDX_9B96C69FD725330D ON individuelclient');
    }
}
