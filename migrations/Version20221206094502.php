<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206094502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garantie_credit (id INT AUTO_INCREMENT NOT NULL, produit_epargne_id INT DEFAULT NULL, credit_base_epargne TINYINT(1) NOT NULL, montant_credit_dmd_individuel DOUBLE PRECISION DEFAULT NULL, montant_credit_dmd_groupe DOUBLE PRECISION DEFAULT NULL, montant_crd_anciens_crediten_cours DOUBLE PRECISION DEFAULT NULL, montant_crd_anciens_crediten_cours_grp DOUBLE PRECISION DEFAULT NULL, garantie_base_montant_credit TINYINT(1) DEFAULT NULL, deduire_garantie_au_decaissement TINYINT(1) DEFAULT NULL, deduire_garantie_au_decaissement_grp TINYINT(1) DEFAULT NULL, garantie_obligatoire_credit_ind TINYINT(1) DEFAULT NULL, montant_exige INT DEFAULT NULL, regle VARCHAR(255) NOT NULL, garant_obligatoire_credit_ind TINYINT(1) DEFAULT NULL, montant_garant INT NOT NULL, garant_obligatoire_credit_grp TINYINT(1) DEFAULT NULL, montant_garantie_grp INT DEFAULT NULL, reglegrp VARCHAR(255) NOT NULL, INDEX IDX_9B3499164C62D160 (produit_epargne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garantie_credit ADD CONSTRAINT FK_9B3499164C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE garantie_credit');
    }
}
