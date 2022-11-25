<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125125857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE configuration_general_credit ADD produit_credit_id INT DEFAULT NULL, ADD devise_id INT DEFAULT NULL, ADD produit_lie_epargne TINYINT(1) NOT NULL, ADD nombre_jour_interet_annee INT NOT NULL, ADD nombre_semaine_annee INT NOT NULL, ADD recalcul_date_echeance_decaissement LONGTEXT NOT NULL, ADD taux_interet_variable_solde_degressif INT NOT NULL, ADD recalcul_interet_remboursement_amortissement_degressif TINYINT(1) NOT NULL, ADD methode_solde_degressif_compose_calcul_interet TINYINT(1) NOT NULL, ADD exclure_prdt_limttion_dmde_et_decaiss_deuxieme_crdt TINYINT(1) NOT NULL, ADD autorisation_decaissement_partiellement TINYINT(1) NOT NULL, ADD acrive_priorite_remboursement_credit TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE configuration_general_credit ADD CONSTRAINT FK_EEABA5FB4A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('ALTER TABLE configuration_general_credit ADD CONSTRAINT FK_EEABA5FBF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('CREATE INDEX IDX_EEABA5FB4A917115 ON configuration_general_credit (produit_credit_id)');
        $this->addSql('CREATE INDEX IDX_EEABA5FBF4445056 ON configuration_general_credit (devise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE configuration_general_credit DROP FOREIGN KEY FK_EEABA5FB4A917115');
        $this->addSql('ALTER TABLE configuration_general_credit DROP FOREIGN KEY FK_EEABA5FBF4445056');
        $this->addSql('DROP INDEX IDX_EEABA5FB4A917115 ON configuration_general_credit');
        $this->addSql('DROP INDEX IDX_EEABA5FBF4445056 ON configuration_general_credit');
        $this->addSql('ALTER TABLE configuration_general_credit DROP produit_credit_id, DROP devise_id, DROP produit_lie_epargne, DROP nombre_jour_interet_annee, DROP nombre_semaine_annee, DROP recalcul_date_echeance_decaissement, DROP taux_interet_variable_solde_degressif, DROP recalcul_interet_remboursement_amortissement_degressif, DROP methode_solde_degressif_compose_calcul_interet, DROP exclure_prdt_limttion_dmde_et_decaiss_deuxieme_crdt, DROP autorisation_decaissement_partiellement, DROP acrive_priorite_remboursement_credit');
    }
}
