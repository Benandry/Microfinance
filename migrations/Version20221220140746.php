<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220140746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_gl1 ADD produit_credit_id INT DEFAULT NULL, ADD cpte_prncpl_en_cours VARCHAR(255) DEFAULT NULL, ADD cpte_provision_mvs_creances VARCHAR(255) DEFAULT NULL, ADD cpte_provsion_cout_mvs_creance VARCHAR(255) DEFAULT NULL, ADD cpt_intrt_recu_crdt VARCHAR(255) DEFAULT NULL, ADD cpte_crdt_passe_perte VARCHAR(255) DEFAULT NULL, ADD cpte_interet_echus VARCHAR(255) DEFAULT NULL, ADD cpte_intrt_echus_recvoir VARCHAR(255) DEFAULT NULL, ADD cpte_refinancmnt_crdt VARCHAR(255) DEFAULT NULL, ADD cpte_pnlts_comptbls_avnce VARCHAR(255) DEFAULT NULL, ADD cpte_rvnue_pnlts_comptbls_avnce VARCHAR(255) DEFAULT NULL, ADD cpte_commssion_accml_gagne VARCHAR(255) DEFAULT NULL, ADD cpte_rcvrmt_crncs_douteuse VARCHAR(255) DEFAULT NULL, ADD cpte_papeterie VARCHAR(255) DEFAULT NULL, ADD cpte_cheque VARCHAR(255) DEFAULT NULL, ADD cpte_surpaiement VARCHAR(255) DEFAULT NULL, ADD cpte_chrg_cheque VARCHAR(255) DEFAULT NULL, ADD cpte_commssion_crdt VARCHAR(255) DEFAULT NULL, ADD cpte_pnlts_crdt VARCHAR(255) NOT NULL, ADD diffrnce_monnaie VARCHAR(255) DEFAULT NULL, ADD papeterie_demande VARCHAR(255) DEFAULT NULL, ADD commission_demande VARCHAR(255) DEFAULT NULL, ADD frais_developpement_dmd VARCHAR(255) DEFAULT NULL, ADD frais_refinancement_demande VARCHAR(255) DEFAULT NULL, ADD papeterie_decaissement VARCHAR(255) DEFAULT NULL, ADD commission_decaissement VARCHAR(255) DEFAULT NULL, ADD majoration_decaissement VARCHAR(255) DEFAULT NULL, ADD frais_developpement_decssmnt VARCHAR(255) DEFAULT NULL, ADD frais_trtement_decaissement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE compte_gl1 ADD CONSTRAINT FK_7A07AD1B4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('CREATE INDEX IDX_7A07AD1B4A917115 ON compte_gl1 (produit_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_gl1 DROP FOREIGN KEY FK_7A07AD1B4A917115');
        $this->addSql('DROP INDEX IDX_7A07AD1B4A917115 ON compte_gl1');
        $this->addSql('ALTER TABLE compte_gl1 DROP produit_credit_id, DROP cpte_prncpl_en_cours, DROP cpte_provision_mvs_creances, DROP cpte_provsion_cout_mvs_creance, DROP cpt_intrt_recu_crdt, DROP cpte_crdt_passe_perte, DROP cpte_interet_echus, DROP cpte_intrt_echus_recvoir, DROP cpte_refinancmnt_crdt, DROP cpte_pnlts_comptbls_avnce, DROP cpte_rvnue_pnlts_comptbls_avnce, DROP cpte_commssion_accml_gagne, DROP cpte_rcvrmt_crncs_douteuse, DROP cpte_papeterie, DROP cpte_cheque, DROP cpte_surpaiement, DROP cpte_chrg_cheque, DROP cpte_commssion_crdt, DROP cpte_pnlts_crdt, DROP diffrnce_monnaie, DROP papeterie_demande, DROP commission_demande, DROP frais_developpement_dmd, DROP frais_refinancement_demande, DROP papeterie_decaissement, DROP commission_decaissement, DROP majoration_decaissement, DROP frais_developpement_decssmnt, DROP frais_trtement_decaissement');
    }
}
