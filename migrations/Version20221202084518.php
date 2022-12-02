<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202084518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE frais_config_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, type_client VARCHAR(255) NOT NULL, papeterie DOUBLE PRECISION NOT NULL, commission DOUBLE PRECISION NOT NULL, frais_de_developpement DOUBLE PRECISION NOT NULL, frais_de_refinancement DOUBLE PRECISION NOT NULL, commission_credit_chaque_tranche_ind DOUBLE PRECISION NOT NULL, droit_timbre_sur_capital DOUBLE PRECISION NOT NULL, sur_interet_cours DOUBLE PRECISION NOT NULL, INDEX IDX_F3F7339F4A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE frais_config_credit ADD CONSTRAINT FK_F3F7339F4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE frais_config_credit');
    }
}
