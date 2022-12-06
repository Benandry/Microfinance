<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:migrations/Version20221206131705.php
final class Version20221206131705 extends AbstractMigration
========
final class Version20221206123003 extends AbstractMigration
>>>>>>>> 71e8f540deffe9243bf76ce69c86908561a806bc:migrations/Version20221206123003.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20221206131705.php
        $this->addSql('ALTER TABLE garantie_credit CHANGE credit_base_epargne credit_base_epargne TINYINT(1) DEFAULT NULL, CHANGE montant_garant montant_garant INT DEFAULT NULL');
========
        $this->addSql('ALTER TABLE approbation_credit ADD montant DOUBLE PRECISION NOT NULL');
>>>>>>>> 71e8f540deffe9243bf76ce69c86908561a806bc:migrations/Version20221206123003.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20221206131705.php
        $this->addSql('ALTER TABLE garantie_credit CHANGE credit_base_epargne credit_base_epargne TINYINT(1) NOT NULL, CHANGE montant_garant montant_garant INT NOT NULL');
========
        $this->addSql('ALTER TABLE approbation_credit DROP montant');
>>>>>>>> 71e8f540deffe9243bf76ce69c86908561a806bc:migrations/Version20221206123003.php
    }
}
