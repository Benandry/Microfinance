<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202072021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE configuration_general_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, devise_id INT DEFAULT NULL, produit_lie_epargne TINYINT(1) NOT NULL, nombre_jour_interet_annee INT NOT NULL, nombre_semaine_annee INT NOT NULL, recalcul_date_echeance_decaissement LONGTEXT NOT NULL, taux_interet_variable_solde_degressif INT NOT NULL, recalcul_interet_remboursement_amortissement_degressif TINYINT(1) NOT NULL, methode_solde_degressif_compose_calcul_interet TINYINT(1) NOT NULL, exclure_prdt_limttion_dmde_et_decaiss_deuxieme_crdt TINYINT(1) NOT NULL, autorisation_decaissement_partiellement TINYINT(1) NOT NULL, acrive_priorite_remboursement_credit TINYINT(1) NOT NULL, INDEX IDX_EEABA5FB4A917115 (produit_credit_id), INDEX IDX_EEABA5FBF4445056 (devise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_individuel (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, taux_interet_annuel DOUBLE PRECISION NOT NULL, differement_payement DOUBLE PRECISION NOT NULL, tranche INT NOT NULL, type_tranche VARCHAR(255) NOT NULL, calcul_interet VARCHAR(255) NOT NULL, montant_minimum_credit DOUBLE PRECISION NOT NULL, montant_maximum_credit DOUBLE PRECISION NOT NULL, delais_de_grace_maxi INT NOT NULL, paiement_prealable_interet TINYINT(1) NOT NULL, calcul_intert_pour_differe TINYINT(1) NOT NULL, intaret_differe_paiement_capitalise TINYINT(1) NOT NULL, interet_payer_differe TINYINT(1) NOT NULL, tranche_distinct_interet TINYINT(1) NOT NULL, interet_deduct_decaissement TINYINT(1) NOT NULL, calcul_interet_jours TINYINT(1) NOT NULL, forfait_paiement_prealable_interet TINYINT(1) NOT NULL, periode_minimum_credit INT NOT NULL, periode_maximum_credit INT NOT NULL, INDEX IDX_108782AD4A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_credit (id INT AUTO_INCREMENT NOT NULL, produit_epargne_id INT DEFAULT NULL, produit_credit_id INT DEFAULT NULL, codeclient VARCHAR(255) NOT NULL, type_client VARCHAR(255) NOT NULL, numero_credit VARCHAR(255) NOT NULL, date_demande DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, taux_interet_annuel DOUBLE PRECISION NOT NULL, nombre_tranche INT NOT NULL, type_tranche VARCHAR(255) NOT NULL, methode_calcul_interet VARCHAR(255) NOT NULL, differe_de_paiement INT NOT NULL, capital_derniere_echeance DOUBLE PRECISION NOT NULL, fond_credit VARCHAR(255) NOT NULL, montant_epargne_tranche DOUBLE PRECISION NOT NULL, montant_fixe DOUBLE PRECISION NOT NULL, solde_epargne VARCHAR(255) NOT NULL, agent VARCHAR(255) NOT NULL, but_credit VARCHAR(255) NOT NULL, categorie1_credit VARCHAR(255) NOT NULL, categorie2_credit VARCHAR(255) NOT NULL, categorie3_credit VARCHAR(255) NOT NULL, categorie4_credit VARCHAR(255) NOT NULL, calcul_interet_differe TINYINT(1) NOT NULL, interet_differe_paiement_capitalise TINYINT(1) NOT NULL, interet_paye_meme_pour_differe TINYINT(1) NOT NULL, tranche_distinct_interet_periode_differe TINYINT(1) NOT NULL, paiement_prealable_interet TINYINT(1) NOT NULL, interet_deduit_decaissement TINYINT(1) NOT NULL, calcul_interet_jours TINYINT(1) NOT NULL, forfait_paiement_prealable_interet TINYINT(1) NOT NULL, credit_lie_usd TINYINT(1) NOT NULL, mettre_jour_calendrier_non_ouvrable TINYINT(1) NOT NULL, reporter_premier_tranche TINYINT(1) NOT NULL, commission_pourcentage_montant_credit TINYINT(1) NOT NULL, pourcentage_capital_en_cours_interet_commission DOUBLE PRECISION NOT NULL, montant_fixe_par_tranche DOUBLE PRECISION NOT NULL, INDEX IDX_5E8528114C62D160 (produit_epargne_id), INDEX IDX_5E8528114A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_credit (id INT AUTO_INCREMENT NOT NULL, nom_produit_credit VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE configuration_general_credit ADD CONSTRAINT FK_EEABA5FB4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE configuration_general_credit ADD CONSTRAINT FK_EEABA5FBF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE credit_individuel ADD CONSTRAINT FK_108782AD4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE user ADD codeagence VARCHAR(10) NOT NULL, ADD nomagence VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE configuration_general_credit DROP FOREIGN KEY FK_EEABA5FB4A917115');
        $this->addSql('ALTER TABLE credit_individuel DROP FOREIGN KEY FK_108782AD4A917115');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528114A917115');
        $this->addSql('DROP TABLE configuration_general_credit');
        $this->addSql('DROP TABLE credit_individuel');
        $this->addSql('DROP TABLE demande_credit');
        $this->addSql('DROP TABLE produit_credit');
        $this->addSql('ALTER TABLE user DROP codeagence, DROP nomagence');
    }
}
