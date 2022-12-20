<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220093238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, nom_agence VARCHAR(255) NOT NULL, adress_agence VARCHAR(255) NOT NULL, commune VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amortissement_fixe (id INT AUTO_INCREMENT NOT NULL, periode INT NOT NULL, date_remborsement DATE NOT NULL, principale DOUBLE PRECISION NOT NULL, interet DOUBLE PRECISION NOT NULL, montantt_total DOUBLE PRECISION NOT NULL, codeclient VARCHAR(255) NOT NULL, remboursement DOUBLE PRECISION DEFAULT NULL, annuite DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE approbation_credit (id INT AUTO_INCREMENT NOT NULL, date_approbation DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, status_approbation VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, codecredit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE approuver_client (id INT AUTO_INCREMENT NOT NULL, codeclient_id INT DEFAULT NULL, dateapprobation DATE NOT NULL, INDEX IDX_387761DCCEAA546A (codeclient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_credit (id INT AUTO_INCREMENT NOT NULL, nom_categorie_credit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_mobile (id INT AUTO_INCREMENT NOT NULL, code_client VARCHAR(10) NOT NULL, type_client VARCHAR(10) NOT NULL, produit_epargne VARCHAR(100) NOT NULL, actif TINYINT(1) NOT NULL, numero_mobile VARCHAR(50) NOT NULL, code_pin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, nom_commune VARCHAR(255) NOT NULL, code_commune VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_epargne (id INT AUTO_INCREMENT NOT NULL, codeclient_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, datedebut DATE NOT NULL, type_client VARCHAR(50) NOT NULL, codeep VARCHAR(50) DEFAULT NULL, codeepargne VARCHAR(30) DEFAULT NULL, codegroupe VARCHAR(255) DEFAULT NULL, codegroupeepargne VARCHAR(255) DEFAULT NULL, INDEX IDX_19FDB51ACEAA546A (codeclient_id), INDEX IDX_19FDB51AF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_gl1 (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, cpte_provision_mauvaise_creances_id INT DEFAULT NULL, cpte_principale_en_cours_id INT DEFAULT NULL, cpte_prvsion_cout_mauvaise_creance_id INT DEFAULT NULL, cpte_interet_recu_credit_id INT DEFAULT NULL, cpte_credit_passe_perte_id INT DEFAULT NULL, cpte_interet_echus_id INT DEFAULT NULL, cpte_interet_echus_recevoir_id INT DEFAULT NULL, cpte_refinancement_credit_id INT DEFAULT NULL, cpte_pnlte_comptablilise_avance_id INT DEFAULT NULL, cpte_revenue_pnlte_comptbls_avnc_id INT DEFAULT NULL, cpte_commission_echues_accumulle_id INT DEFAULT NULL, cpte_commission_accumulle_gagne_id INT DEFAULT NULL, cpte_recvrmnt_creance_douteuse_id INT DEFAULT NULL, cpte_papeterie_id INT DEFAULT NULL, cpte_cheque_id INT DEFAULT NULL, cpte_surpaiement_id INT DEFAULT NULL, cpte_charge_cheque_id INT DEFAULT NULL, cpte_commission_credit_id INT DEFAULT NULL, cpte_pnlte_crdt_id INT DEFAULT NULL, difference_monnaie_id INT DEFAULT NULL, papeterie_id INT DEFAULT NULL, commission_id INT DEFAULT NULL, frais_developpement_id INT DEFAULT NULL, frais_refinancement_id INT DEFAULT NULL, papeterie_decaissement_id INT DEFAULT NULL, commisssion_decaissement_id INT DEFAULT NULL, majoration_decaissement_id INT DEFAULT NULL, frais_dvlppmnt_decaissement_id INT DEFAULT NULL, frais_traitement_decaissement_id INT DEFAULT NULL, INDEX IDX_7A07AD1B4A917115 (produit_credit_id), INDEX IDX_7A07AD1B652550F9 (cpte_provision_mauvaise_creances_id), INDEX IDX_7A07AD1B2BAA6268 (cpte_principale_en_cours_id), INDEX IDX_7A07AD1B650ED9A1 (cpte_prvsion_cout_mauvaise_creance_id), INDEX IDX_7A07AD1B671196A (cpte_interet_recu_credit_id), INDEX IDX_7A07AD1BF20AED24 (cpte_credit_passe_perte_id), INDEX IDX_7A07AD1B8F6AB2B1 (cpte_interet_echus_id), INDEX IDX_7A07AD1BC81BA694 (cpte_interet_echus_recevoir_id), INDEX IDX_7A07AD1B7EDB5EFA (cpte_refinancement_credit_id), INDEX IDX_7A07AD1B99ABD56C (cpte_pnlte_comptablilise_avance_id), INDEX IDX_7A07AD1B6DD7E9D7 (cpte_revenue_pnlte_comptbls_avnc_id), INDEX IDX_7A07AD1B6B5024E8 (cpte_commission_echues_accumulle_id), INDEX IDX_7A07AD1BF551D5E6 (cpte_commission_accumulle_gagne_id), INDEX IDX_7A07AD1B499352C8 (cpte_recvrmnt_creance_douteuse_id), INDEX IDX_7A07AD1B7F5B2553 (cpte_papeterie_id), INDEX IDX_7A07AD1BEF93D60 (cpte_cheque_id), INDEX IDX_7A07AD1BED606CC6 (cpte_surpaiement_id), INDEX IDX_7A07AD1B303B041A (cpte_charge_cheque_id), INDEX IDX_7A07AD1B858B2D78 (cpte_commission_credit_id), INDEX IDX_7A07AD1BACC1A849 (cpte_pnlte_crdt_id), INDEX IDX_7A07AD1B822E4F0D (difference_monnaie_id), INDEX IDX_7A07AD1B98DC11DD (papeterie_id), INDEX IDX_7A07AD1B202D1EB2 (commission_id), INDEX IDX_7A07AD1BFD3A2A (frais_developpement_id), INDEX IDX_7A07AD1B5B2492B1 (frais_refinancement_id), INDEX IDX_7A07AD1B4E36B405 (papeterie_decaissement_id), INDEX IDX_7A07AD1B966F2EE (commisssion_decaissement_id), INDEX IDX_7A07AD1B564CC8FF (majoration_decaissement_id), INDEX IDX_7A07AD1BCD4D7516 (frais_dvlppmnt_decaissement_id), INDEX IDX_7A07AD1B5BF485F6 (frais_traitement_decaissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_ep (id INT AUTO_INCREMENT NOT NULL, produit_epargne_id INT DEFAULT NULL, deviseutiliser_id INT DEFAULT NULL, is_negatif TINYINT(1) NOT NULL, nbrj_inactif INT NOT NULL, nb_min_ret INT NOT NULL, nbr_jr_max_dep INT NOT NULL, age_min_cpt INT NOT NULL, frais_tenu_cpt DOUBLE PRECISION NOT NULL, commission_ret_cash DOUBLE PRECISION NOT NULL, commission_transf DOUBLE PRECISION NOT NULL, frais_ferm_cpt DOUBLE PRECISION NOT NULL, soldeouvert DOUBLE PRECISION NOT NULL, INDEX IDX_92B49DF24C62D160 (produit_epargne_id), INDEX IDX_92B49DF2A6D70781 (deviseutiliser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration_general_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, devise_id INT DEFAULT NULL, produit_lie_epargne TINYINT(1) NOT NULL, nombre_jour_interet_annee INT NOT NULL, nombre_semaine_annee INT NOT NULL, recalcul_date_echeance_decaissement LONGTEXT NOT NULL, taux_interet_variable_solde_degressif INT NOT NULL, recalcul_interet_remboursement_amortissement_degressif TINYINT(1) NOT NULL, methode_solde_degressif_compose_calcul_interet TINYINT(1) NOT NULL, exclure_prdt_limttion_dmde_et_decaiss_deuxieme_crdt TINYINT(1) NOT NULL, autorisation_decaissement_partiellement TINYINT(1) NOT NULL, acrive_priorite_remboursement_credit TINYINT(1) NOT NULL, INDEX IDX_EEABA5FB4A917115 (produit_credit_id), INDEX IDX_EEABA5FBF4445056 (devise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_individuel (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, taux_interet_annuel DOUBLE PRECISION NOT NULL, differement_payement DOUBLE PRECISION NOT NULL, tranche INT NOT NULL, type_tranche VARCHAR(255) NOT NULL, calcul_interet VARCHAR(255) NOT NULL, montant_minimum_credit DOUBLE PRECISION NOT NULL, montant_maximum_credit DOUBLE PRECISION NOT NULL, delais_de_grace_maxi INT NOT NULL, paiement_prealable_interet TINYINT(1) NOT NULL, calcul_intert_pour_differe TINYINT(1) NOT NULL, intaret_differe_paiement_capitalise TINYINT(1) NOT NULL, interet_payer_differe TINYINT(1) NOT NULL, tranche_distinct_interet TINYINT(1) NOT NULL, interet_deduct_decaissement TINYINT(1) NOT NULL, calcul_interet_jours TINYINT(1) NOT NULL, forfait_paiement_prealable_interet TINYINT(1) NOT NULL, periode_minimum_credit INT NOT NULL, periode_maximum_credit INT NOT NULL, INDEX IDX_108782AD4A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, codeclient VARCHAR(255) NOT NULL, type_client VARCHAR(255) NOT NULL, numero_credit VARCHAR(255) NOT NULL, date_demande DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, taux_interet_annuel DOUBLE PRECISION NOT NULL, nombre_tranche INT NOT NULL, type_tranche VARCHAR(255) NOT NULL, methode_calcul_interet VARCHAR(255) NOT NULL, differe_de_paiement INT NOT NULL, capital_derniere_echeance DOUBLE PRECISION NOT NULL, solde_epargne VARCHAR(255) NOT NULL, agent VARCHAR(255) NOT NULL, calcul_interet_differe TINYINT(1) DEFAULT NULL, calcul_interet_jours TINYINT(1) DEFAULT NULL, status_app VARCHAR(255) DEFAULT NULL, categorie1_credit VARCHAR(255) DEFAULT NULL, fond_credit VARCHAR(255) DEFAULT NULL, type_amortissement VARCHAR(255) DEFAULT NULL, INDEX IDX_5E8528114A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot_aterme (id INT AUTO_INCREMENT NOT NULL, compte_id INT NOT NULL, produit_id INT DEFAULT NULL, datedepot DATETIME NOT NULL, piececomptable VARCHAR(20) NOT NULL, tauxinteret DOUBLE PRECISION NOT NULL, periodemois INT NOT NULL, is_interetcapitalise TINYINT(1) NOT NULL, date_echeance DATETIME NOT NULL, valeurecheance DOUBLE PRECISION NOT NULL, taxeretenue DOUBLE PRECISION NOT NULL, retenuetaxe DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, is_depotcall TINYINT(1) NOT NULL, is_interetecheance TINYINT(1) NOT NULL, is_interetmois TINYINT(1) NOT NULL, is_interettrimestrielle TINYINT(1) NOT NULL, is_interetsemestrielle TINYINT(1) NOT NULL, is_interetpayelorscalcul TINYINT(1) NOT NULL, _is_interettransferercptep TINYINT(1) NOT NULL, is_retirealecheance TINYINT(1) NOT NULL, is_remetreaucptalecheance TINYINT(1) NOT NULL, INDEX IDX_80EAC779F2C56620 (compte_id), INDEX IDX_80EAC779F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devise (id INT AUTO_INCREMENT NOT NULL, devise VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etatcivile (id INT AUTO_INCREMENT NOT NULL, etatcivile VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etude (id INT AUTO_INCREMENT NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fond_credit (id INT AUTO_INCREMENT NOT NULL, devise_id INT DEFAULT NULL, nom_bailleurs VARCHAR(255) DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, date DATE DEFAULT NULL, numero_compte VARCHAR(255) DEFAULT NULL, INDEX IDX_4B94101EF4445056 (devise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais_config_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, type_client VARCHAR(255) NOT NULL, papeterie DOUBLE PRECISION NOT NULL, commission DOUBLE PRECISION NOT NULL, frais_de_developpement DOUBLE PRECISION NOT NULL, frais_de_refinancement DOUBLE PRECISION NOT NULL, commission_credit_chaque_tranche_ind DOUBLE PRECISION NOT NULL, droit_timbre_sur_capital DOUBLE PRECISION NOT NULL, sur_interet_cours DOUBLE PRECISION NOT NULL, INDEX IDX_F3F7339F4A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garantie_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, credit_base_epargne TINYINT(1) DEFAULT NULL, produit_epargne VARCHAR(255) DEFAULT NULL, montant_credit_dmd_individuel DOUBLE PRECISION DEFAULT NULL, montant_credit_dmd_groupe DOUBLE PRECISION DEFAULT NULL, montant_crd_anciens_crediten_cours DOUBLE PRECISION DEFAULT NULL, montant_crd_anciens_crediten_cours_grp DOUBLE PRECISION DEFAULT NULL, garantie_base_montant_credit TINYINT(1) DEFAULT NULL, deduire_garantie_au_decaissement TINYINT(1) DEFAULT NULL, deduire_garantie_au_decaissement_grp TINYINT(1) DEFAULT NULL, garantie_obligatoire_credit_ind TINYINT(1) DEFAULT NULL, montant_exige INT DEFAULT NULL, regle VARCHAR(255) NOT NULL, garant_obligatoire_credit_ind TINYINT(1) DEFAULT NULL, montant_garant INT DEFAULT NULL, garant_obligatoire_credit_grp TINYINT(1) DEFAULT NULL, montant_garantie_grp INT DEFAULT NULL, reglegrp VARCHAR(255) DEFAULT NULL, INDEX IDX_9B3499164A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom_groupe VARCHAR(255) NOT NULL, date_inscription DATE NOT NULL, numero_mobile VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, codegroupe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individuelclient (id INT AUTO_INCREMENT NOT NULL, etatcivile_id INT DEFAULT NULL, etude_id INT DEFAULT NULL, titre_id INT DEFAULT NULL, membre_groupe_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom_client VARCHAR(100) NOT NULL, prenom_client VARCHAR(100) NOT NULL, cin VARCHAR(100) NOT NULL, nom_conjoint VARCHAR(255) NOT NULL, date_inscription DATE NOT NULL, sexe VARCHAR(10) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, numero_mobile VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, nb_enfant INT NOT NULL, nb_personne_charge INT NOT NULL, parent_nom VARCHAR(255) DEFAULT NULL, parent_adresse VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, adressephysique VARCHAR(255) NOT NULL, titre_groupe VARCHAR(255) NOT NULL, lieudelivrance VARCHAR(255) NOT NULL, datecin DATE NOT NULL, dateexpiration DATE NOT NULL, type_identite VARCHAR(255) NOT NULL, dateadhesion DATE DEFAULT NULL, codeclient VARCHAR(30) DEFAULT NULL, commune VARCHAR(255) NOT NULL, agence VARCHAR(255) DEFAULT NULL, garant TINYINT(1) DEFAULT NULL, nom_agence VARCHAR(255) DEFAULT NULL, code_agence VARCHAR(255) DEFAULT NULL, INDEX IDX_9B96C69F962FC573 (etatcivile_id), INDEX IDX_9B96C69F47ABD362 (etude_id), INDEX IDX_9B96C69FD54FAE5E (titre_id), INDEX IDX_9B96C69FC5203672 (membre_groupe_id), INDEX IDX_9B96C69FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individuelclient_compte_epargne (individuelclient_id INT NOT NULL, compte_epargne_id INT NOT NULL, INDEX IDX_8246D5B14C27CDF (individuelclient_id), INDEX IDX_8246D5B2D4E37D3 (compte_epargne_id), PRIMARY KEY(individuelclient_id, compte_epargne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journal_comptabilite (id INT AUTO_INCREMENT NOT NULL, compteepargne VARCHAR(15) NOT NULL, debit INT NOT NULL, credit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, langue VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_rouge (id INT AUTO_INCREMENT NOT NULL, codegroupe_id INT DEFAULT NULL, codeclient_id INT DEFAULT NULL, dateliste DATE NOT NULL, raison VARCHAR(255) NOT NULL, type_client VARCHAR(120) NOT NULL, INDEX IDX_7CD0B545AD0408C7 (codegroupe_id), INDEX IDX_7CD0B545CEAA546A (codeclient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobile (id INT AUTO_INCREMENT NOT NULL, code_client_id INT DEFAULT NULL, INDEX IDX_3C7323E0B5AE1119 (code_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_comptable (id INT AUTO_INCREMENT NOT NULL, numero_compte VARCHAR(255) DEFAULT NULL, libelle LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_credit (id INT AUTO_INCREMENT NOT NULL, produit_credit_id INT DEFAULT NULL, nom_produit_credit VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_EB93A5C44A917115 (produit_credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_epargne (id INT AUTO_INCREMENT NOT NULL, type_epargne_id INT DEFAULT NULL, nomproduit VARCHAR(255) NOT NULL, isdesactive TINYINT(1) NOT NULL, INDEX IDX_67610235F8593E48 (type_epargne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produittransfert (id INT AUTO_INCREMENT NOT NULL, compte1_id INT DEFAULT NULL, compte2_id INT DEFAULT NULL, datetransfert DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_1991DBC8EDF0C83D (compte1_id), INDEX IDX_1991DBC8FF4567D3 (compte2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi_client (id INT AUTO_INCREMENT NOT NULL, date_entre DATE NOT NULL, date_sortie DATE NOT NULL, utilisateur VARCHAR(255) NOT NULL, menu_utiliser VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE titre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, piece_comptable VARCHAR(50) NOT NULL, date_transaction DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, papeterie DOUBLE PRECISION NOT NULL, commission DOUBLE PRECISION NOT NULL, type_client VARCHAR(100) NOT NULL, solde VARCHAR(255) DEFAULT NULL, codetransaction INT DEFAULT NULL, codeepargneclient VARCHAR(30) DEFAULT NULL, codeepargnegroupe VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfert_produit (id INT AUTO_INCREMENT NOT NULL, produitatransferer_id INT DEFAULT NULL, produittransmis_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, datetransfert DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_BCF83C4EE4059086 (produitatransferer_id), INDEX IDX_BCF83C4E8E88FB7D (produittransmis_id), INDEX IDX_BCF83C4EF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfertep (id INT AUTO_INCREMENT NOT NULL, description_t VARCHAR(100) NOT NULL, piece_comptable_t VARCHAR(30) NOT NULL, date_transaction_t DATE NOT NULL, montantdestinataire INT NOT NULL, papeterie INT NOT NULL, commission INT NOT NULL, type_client_t VARCHAR(100) NOT NULL, soldedestinataire VARCHAR(255) DEFAULT NULL, soldeenvoyeur INT NOT NULL, codetransaction_t VARCHAR(255) NOT NULL, codedestinateur VARCHAR(20) NOT NULL, codeenvoyeur VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_epargne (id INT AUTO_INCREMENT NOT NULL, nom_type_ep VARCHAR(255) NOT NULL, abreviation VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, responsabilite VARCHAR(255) NOT NULL, codeagence VARCHAR(10) NOT NULL, nomagence VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE approuver_client ADD CONSTRAINT FK_387761DCCEAA546A FOREIGN KEY (codeclient_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE compte_epargne ADD CONSTRAINT FK_19FDB51ACEAA546A FOREIGN KEY (codeclient_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE compte_epargne ADD CONSTRAINT FK_19FDB51AF347EFB FOREIGN KEY (produit_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B652550F9 FOREIGN KEY (cpte_provision_mauvaise_creances_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B2BAA6268 FOREIGN KEY (cpte_principale_en_cours_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B650ED9A1 FOREIGN KEY (cpte_prvsion_cout_mauvaise_creance_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B671196A FOREIGN KEY (cpte_interet_recu_credit_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BF20AED24 FOREIGN KEY (cpte_credit_passe_perte_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B8F6AB2B1 FOREIGN KEY (cpte_interet_echus_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BC81BA694 FOREIGN KEY (cpte_interet_echus_recevoir_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B7EDB5EFA FOREIGN KEY (cpte_refinancement_credit_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B99ABD56C FOREIGN KEY (cpte_pnlte_comptablilise_avance_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B6DD7E9D7 FOREIGN KEY (cpte_revenue_pnlte_comptbls_avnc_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B6B5024E8 FOREIGN KEY (cpte_commission_echues_accumulle_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BF551D5E6 FOREIGN KEY (cpte_commission_accumulle_gagne_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B499352C8 FOREIGN KEY (cpte_recvrmnt_creance_douteuse_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B7F5B2553 FOREIGN KEY (cpte_papeterie_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BEF93D60 FOREIGN KEY (cpte_cheque_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BED606CC6 FOREIGN KEY (cpte_surpaiement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B303B041A FOREIGN KEY (cpte_charge_cheque_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B858B2D78 FOREIGN KEY (cpte_commission_credit_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BACC1A849 FOREIGN KEY (cpte_pnlte_crdt_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B822E4F0D FOREIGN KEY (difference_monnaie_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B98DC11DD FOREIGN KEY (papeterie_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B202D1EB2 FOREIGN KEY (commission_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BFD3A2A FOREIGN KEY (frais_developpement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B5B2492B1 FOREIGN KEY (frais_refinancement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B4E36B405 FOREIGN KEY (papeterie_decaissement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B966F2EE FOREIGN KEY (commisssion_decaissement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B564CC8FF FOREIGN KEY (majoration_decaissement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1BCD4D7516 FOREIGN KEY (frais_dvlppmnt_decaissement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B5BF485F6 FOREIGN KEY (frais_traitement_decaissement_id) REFERENCES plan_comptable (id)');
        $this->addSql('ALTER TABLE config_ep ADD CONSTRAINT FK_92B49DF24C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE config_ep ADD CONSTRAINT FK_92B49DF2A6D70781 FOREIGN KEY (deviseutiliser_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE configuration_general_credit ADD CONSTRAINT FK_EEABA5FB4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE configuration_general_credit ADD CONSTRAINT FK_EEABA5FBF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE credit_individuel ADD CONSTRAINT FK_108782AD4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE depot_aterme ADD CONSTRAINT FK_80EAC779F2C56620 FOREIGN KEY (compte_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE depot_aterme ADD CONSTRAINT FK_80EAC779F347EFB FOREIGN KEY (produit_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE fond_credit ADD CONSTRAINT FK_4B94101EF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE frais_config_credit ADD CONSTRAINT FK_F3F7339F4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE garantie_credit ADD CONSTRAINT FK_9B3499164A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69F962FC573 FOREIGN KEY (etatcivile_id) REFERENCES etatcivile (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69F47ABD362 FOREIGN KEY (etude_id) REFERENCES etude (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FD54FAE5E FOREIGN KEY (titre_id) REFERENCES titre (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FC5203672 FOREIGN KEY (membre_groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE individuelclient_compte_epargne ADD CONSTRAINT FK_8246D5B14C27CDF FOREIGN KEY (individuelclient_id) REFERENCES individuelclient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE individuelclient_compte_epargne ADD CONSTRAINT FK_8246D5B2D4E37D3 FOREIGN KEY (compte_epargne_id) REFERENCES compte_epargne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_rouge ADD CONSTRAINT FK_7CD0B545AD0408C7 FOREIGN KEY (codegroupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE liste_rouge ADD CONSTRAINT FK_7CD0B545CEAA546A FOREIGN KEY (codeclient_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE mobile ADD CONSTRAINT FK_3C7323E0B5AE1119 FOREIGN KEY (code_client_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE produit_credit ADD CONSTRAINT FK_EB93A5C44A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE produit_epargne ADD CONSTRAINT FK_67610235F8593E48 FOREIGN KEY (type_epargne_id) REFERENCES type_epargne (id)');
        $this->addSql('ALTER TABLE produittransfert ADD CONSTRAINT FK_1991DBC8EDF0C83D FOREIGN KEY (compte1_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE produittransfert ADD CONSTRAINT FK_1991DBC8FF4567D3 FOREIGN KEY (compte2_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert_produit ADD CONSTRAINT FK_BCF83C4EE4059086 FOREIGN KEY (produitatransferer_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert_produit ADD CONSTRAINT FK_BCF83C4E8E88FB7D FOREIGN KEY (produittransmis_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert_produit ADD CONSTRAINT FK_BCF83C4EF2C56620 FOREIGN KEY (compte_id) REFERENCES compte_epargne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individuelclient_compte_epargne DROP FOREIGN KEY FK_8246D5B2D4E37D3');
        $this->addSql('ALTER TABLE produittransfert DROP FOREIGN KEY FK_1991DBC8EDF0C83D');
        $this->addSql('ALTER TABLE produittransfert DROP FOREIGN KEY FK_1991DBC8FF4567D3');
        $this->addSql('ALTER TABLE transfert_produit DROP FOREIGN KEY FK_BCF83C4EE4059086');
        $this->addSql('ALTER TABLE transfert_produit DROP FOREIGN KEY FK_BCF83C4E8E88FB7D');
        $this->addSql('ALTER TABLE transfert_produit DROP FOREIGN KEY FK_BCF83C4EF2C56620');
        $this->addSql('ALTER TABLE config_ep DROP FOREIGN KEY FK_92B49DF2A6D70781');
        $this->addSql('ALTER TABLE configuration_general_credit DROP FOREIGN KEY FK_EEABA5FBF4445056');
        $this->addSql('ALTER TABLE fond_credit DROP FOREIGN KEY FK_4B94101EF4445056');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69F962FC573');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69F47ABD362');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FC5203672');
        $this->addSql('ALTER TABLE liste_rouge DROP FOREIGN KEY FK_7CD0B545AD0408C7');
        $this->addSql('ALTER TABLE approuver_client DROP FOREIGN KEY FK_387761DCCEAA546A');
        $this->addSql('ALTER TABLE compte_epargne DROP FOREIGN KEY FK_19FDB51ACEAA546A');
        $this->addSql('ALTER TABLE depot_aterme DROP FOREIGN KEY FK_80EAC779F2C56620');
        $this->addSql('ALTER TABLE individuelclient_compte_epargne DROP FOREIGN KEY FK_8246D5B14C27CDF');
        $this->addSql('ALTER TABLE liste_rouge DROP FOREIGN KEY FK_7CD0B545CEAA546A');
        $this->addSql('ALTER TABLE mobile DROP FOREIGN KEY FK_3C7323E0B5AE1119');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B652550F9');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B2BAA6268');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B650ED9A1');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B671196A');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BF20AED24');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B8F6AB2B1');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BC81BA694');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B7EDB5EFA');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B99ABD56C');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B6DD7E9D7');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B6B5024E8');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BF551D5E6');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B499352C8');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B7F5B2553');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BEF93D60');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BED606CC6');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B303B041A');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B858B2D78');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BACC1A849');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B822E4F0D');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B98DC11DD');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B202D1EB2');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BFD3A2A');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B5B2492B1');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B4E36B405');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B966F2EE');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B564CC8FF');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1BCD4D7516');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B5BF485F6');
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B4A917115');
        $this->addSql('ALTER TABLE configuration_general_credit DROP FOREIGN KEY FK_EEABA5FB4A917115');
        $this->addSql('ALTER TABLE credit_individuel DROP FOREIGN KEY FK_108782AD4A917115');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528114A917115');
        $this->addSql('ALTER TABLE frais_config_credit DROP FOREIGN KEY FK_F3F7339F4A917115');
        $this->addSql('ALTER TABLE garantie_credit DROP FOREIGN KEY FK_9B3499164A917115');
        $this->addSql('ALTER TABLE produit_credit DROP FOREIGN KEY FK_EB93A5C44A917115');
        $this->addSql('ALTER TABLE compte_epargne DROP FOREIGN KEY FK_19FDB51AF347EFB');
        $this->addSql('ALTER TABLE config_ep DROP FOREIGN KEY FK_92B49DF24C62D160');
        $this->addSql('ALTER TABLE depot_aterme DROP FOREIGN KEY FK_80EAC779F347EFB');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FD54FAE5E');
        $this->addSql('ALTER TABLE produit_epargne DROP FOREIGN KEY FK_67610235F8593E48');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FA76ED395');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE amortissement_fixe');
        $this->addSql('DROP TABLE approbation_credit');
        $this->addSql('DROP TABLE approuver_client');
        $this->addSql('DROP TABLE categorie_credit');
        $this->addSql('DROP TABLE client_mobile');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE compte_epargne');
        $this->addSql('DROP TABLE compte_gl1');
        $this->addSql('DROP TABLE config_ep');
        $this->addSql('DROP TABLE configuration_general_credit');
        $this->addSql('DROP TABLE credit_individuel');
        $this->addSql('DROP TABLE demande_credit');
        $this->addSql('DROP TABLE depot_aterme');
        $this->addSql('DROP TABLE devise');
        $this->addSql('DROP TABLE etatcivile');
        $this->addSql('DROP TABLE etude');
        $this->addSql('DROP TABLE fond_credit');
        $this->addSql('DROP TABLE frais_config_credit');
        $this->addSql('DROP TABLE garantie_credit');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE individuelclient');
        $this->addSql('DROP TABLE individuelclient_compte_epargne');
        $this->addSql('DROP TABLE journal_comptabilite');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE liste_rouge');
        $this->addSql('DROP TABLE mobile');
        $this->addSql('DROP TABLE plan_comptable');
        $this->addSql('DROP TABLE produit_credit');
        $this->addSql('DROP TABLE produit_epargne');
        $this->addSql('DROP TABLE produittransfert');
        $this->addSql('DROP TABLE suivi_client');
        $this->addSql('DROP TABLE titre');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE transfert_produit');
        $this->addSql('DROP TABLE transfertep');
        $this->addSql('DROP TABLE type_epargne');
        $this->addSql('DROP TABLE user');
    }
}
