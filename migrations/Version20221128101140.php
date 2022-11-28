<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128101140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_credit (id INT AUTO_INCREMENT NOT NULL, produit_epargne_id INT DEFAULT NULL, codeclient VARCHAR(255) NOT NULL, type_client VARCHAR(255) NOT NULL, numero_credit VARCHAR(255) NOT NULL, date_demande DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, taux_interet_annuel DOUBLE PRECISION NOT NULL, nombre_tranche INT NOT NULL, type_tranche VARCHAR(255) NOT NULL, methode_calcul_interet VARCHAR(255) NOT NULL, differe_de_paiement INT NOT NULL, capital_derniere_echeance DOUBLE PRECISION NOT NULL, fond_credit VARCHAR(255) NOT NULL, montant_epargne_tranche DOUBLE PRECISION NOT NULL, montant_fixe DOUBLE PRECISION NOT NULL, solde_epargne VARCHAR(255) NOT NULL, agent VARCHAR(255) NOT NULL, but_credit VARCHAR(255) NOT NULL, categorie1_credit VARCHAR(255) NOT NULL, categorie2_credit VARCHAR(255) NOT NULL, categorie3_credit VARCHAR(255) NOT NULL, categorie4_credit VARCHAR(255) NOT NULL, calcul_interet_differe TINYINT(1) NOT NULL, interet_differe_paiement_capitalise TINYINT(1) NOT NULL, interet_paye_meme_pour_differe TINYINT(1) NOT NULL, tranche_distinct_interet_periode_differe TINYINT(1) NOT NULL, paiement_prealable_interet TINYINT(1) NOT NULL, interet_deduit_decaissement TINYINT(1) NOT NULL, calcul_interet_jours TINYINT(1) NOT NULL, forfait_paiement_prealable_interet TINYINT(1) NOT NULL, credit_lie_usd TINYINT(1) NOT NULL, mettre_jour_calendrier_non_ouvrable TINYINT(1) NOT NULL, reporter_premier_tranche TINYINT(1) NOT NULL, commission_pourcentage_montant_credit TINYINT(1) NOT NULL, pourcentage_capital_en_cours_interet_commission DOUBLE PRECISION NOT NULL, montant_fixe_par_tranche DOUBLE PRECISION NOT NULL, INDEX IDX_5E8528114C62D160 (produit_epargne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE demande_credit');
    }
}
