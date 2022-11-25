<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125132212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE credit_individuel (id INT AUTO_INCREMENT NOT NULL, taux_interet_annuel DOUBLE PRECISION NOT NULL, differement_payement DOUBLE PRECISION NOT NULL, tranche INT NOT NULL, type_tranche VARCHAR(255) NOT NULL, calcul_interet VARCHAR(255) NOT NULL, montant_minimum_credit DOUBLE PRECISION NOT NULL, montant_maximum_credit DOUBLE PRECISION NOT NULL, delais_de_grace_maxi INT NOT NULL, paiement_prealable_interet TINYINT(1) NOT NULL, calcul_intert_pour_differe TINYINT(1) NOT NULL, intaret_differe_paiement_capitalise TINYINT(1) NOT NULL, interet_payer_differe TINYINT(1) NOT NULL, tranche_distinct_interet TINYINT(1) NOT NULL, interet_deduct_decaissement TINYINT(1) NOT NULL, calcul_interet_jours TINYINT(1) NOT NULL, forfait_paiement_prealable_interet TINYINT(1) NOT NULL, periode_minimum_credit INT NOT NULL, periode_maximum_credit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE credit_individuel');
    }
}
