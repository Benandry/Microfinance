<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221213083428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528114A917115');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528116EA65534');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E852811479D40B7');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528114C62D160');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E85281186139F77');
        $this->addSql('DROP INDEX IDX_5E85281186139F77 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E8528114C62D160 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E852811479D40B7 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E8528114A917115 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E8528116EA65534 ON demande_credit');
        $this->addSql('ALTER TABLE demande_credit ADD produit_credit VARCHAR(255) NOT NULL, DROP produit_epargne_id, DROP produit_credit_id, DROP categorie2_credit_id, DROP categorie3_credit_id, DROP categorie4_credit_id, DROP interet_differe_paiement_capitalise, DROP interet_paye_meme_pour_differe, DROP tranche_distinct_interet_periode_differe, DROP paiement_prealable_interet, DROP interet_deduit_decaissement, DROP forfait_paiement_prealable_interet, DROP credit_lie_usd, DROP mettre_jour_calendrier_non_ouvrable, DROP reporter_premier_tranche, DROP commission_pourcentage_montant_credit, DROP pourcentage_capital_en_cours_interet_commission, DROP montant_fixe_par_tranche');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_credit ADD produit_epargne_id INT DEFAULT NULL, ADD produit_credit_id INT DEFAULT NULL, ADD categorie2_credit_id INT DEFAULT NULL, ADD categorie3_credit_id INT DEFAULT NULL, ADD categorie4_credit_id INT DEFAULT NULL, ADD interet_differe_paiement_capitalise TINYINT(1) NOT NULL, ADD interet_paye_meme_pour_differe TINYINT(1) NOT NULL, ADD tranche_distinct_interet_periode_differe TINYINT(1) NOT NULL, ADD paiement_prealable_interet TINYINT(1) NOT NULL, ADD interet_deduit_decaissement TINYINT(1) NOT NULL, ADD forfait_paiement_prealable_interet TINYINT(1) NOT NULL, ADD credit_lie_usd TINYINT(1) NOT NULL, ADD mettre_jour_calendrier_non_ouvrable TINYINT(1) NOT NULL, ADD reporter_premier_tranche TINYINT(1) NOT NULL, ADD commission_pourcentage_montant_credit TINYINT(1) NOT NULL, ADD pourcentage_capital_en_cours_interet_commission DOUBLE PRECISION NOT NULL, ADD montant_fixe_par_tranche DOUBLE PRECISION NOT NULL, DROP produit_credit');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528116EA65534 FOREIGN KEY (categorie4_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E852811479D40B7 FOREIGN KEY (categorie3_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528114C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E85281186139F77 FOREIGN KEY (categorie2_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('CREATE INDEX IDX_5E85281186139F77 ON demande_credit (categorie2_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E8528114C62D160 ON demande_credit (produit_epargne_id)');
        $this->addSql('CREATE INDEX IDX_5E852811479D40B7 ON demande_credit (categorie3_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E8528114A917115 ON demande_credit (produit_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E8528116EA65534 ON demande_credit (categorie4_credit_id)');
    }
}
