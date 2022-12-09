<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209075432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garantie_credit (id INT AUTO_INCREMENT NOT NULL, produit_epargne_id INT DEFAULT NULL, credit_base_epargne TINYINT(1) DEFAULT NULL, montant_credit_dmd_individuel DOUBLE PRECISION DEFAULT NULL, montant_credit_dmd_groupe DOUBLE PRECISION DEFAULT NULL, montant_crd_anciens_crediten_cours DOUBLE PRECISION DEFAULT NULL, montant_crd_anciens_crediten_cours_grp DOUBLE PRECISION DEFAULT NULL, garantie_base_montant_credit TINYINT(1) DEFAULT NULL, deduire_garantie_au_decaissement TINYINT(1) DEFAULT NULL, deduire_garantie_au_decaissement_grp TINYINT(1) DEFAULT NULL, garantie_obligatoire_credit_ind TINYINT(1) DEFAULT NULL, montant_exige INT DEFAULT NULL, regle VARCHAR(255) NOT NULL, garant_obligatoire_credit_ind TINYINT(1) DEFAULT NULL, montant_garant INT DEFAULT NULL, garant_obligatoire_credit_grp TINYINT(1) DEFAULT NULL, montant_garantie_grp INT DEFAULT NULL, reglegrp VARCHAR(255) DEFAULT NULL, INDEX IDX_9B3499164C62D160 (produit_epargne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garantie_credit ADD CONSTRAINT FK_9B3499164C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE demande_credit ADD categorie1_credit_id INT DEFAULT NULL, ADD categorie2_credit_id INT DEFAULT NULL, ADD categorie3_credit_id INT DEFAULT NULL, ADD categorie4_credit_id INT DEFAULT NULL, DROP categorie1_credit, DROP categorie2_credit, DROP categorie3_credit, DROP categorie4_credit');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528111FF1F976 FOREIGN KEY (categorie1_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E85281186139F77 FOREIGN KEY (categorie2_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E852811479D40B7 FOREIGN KEY (categorie3_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528116EA65534 FOREIGN KEY (categorie4_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('CREATE INDEX IDX_5E8528111FF1F976 ON demande_credit (categorie1_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E85281186139F77 ON demande_credit (categorie2_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E852811479D40B7 ON demande_credit (categorie3_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E8528116EA65534 ON demande_credit (categorie4_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE garantie_credit');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528111FF1F976');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E85281186139F77');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E852811479D40B7');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528116EA65534');
        $this->addSql('DROP INDEX IDX_5E8528111FF1F976 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E85281186139F77 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E852811479D40B7 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E8528116EA65534 ON demande_credit');
        $this->addSql('ALTER TABLE demande_credit ADD categorie1_credit VARCHAR(255) DEFAULT NULL, ADD categorie2_credit VARCHAR(255) DEFAULT NULL, ADD categorie3_credit VARCHAR(255) DEFAULT NULL, ADD categorie4_credit VARCHAR(255) DEFAULT NULL, DROP categorie1_credit_id, DROP categorie2_credit_id, DROP categorie3_credit_id, DROP categorie4_credit_id');
    }
}
