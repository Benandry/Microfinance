<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221212101144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_credit ADD categorie1_credit_id INT DEFAULT NULL, ADD categorie2_credit_id INT DEFAULT NULL, ADD categorie3_credit_id INT DEFAULT NULL, ADD categorie4_credit_id INT DEFAULT NULL, DROP categorie1_credit, DROP categorie2_credit, DROP categorie3_credit, DROP categorie4_credit');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528111FF1F976 FOREIGN KEY (categorie1_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E85281186139F77 FOREIGN KEY (categorie2_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E852811479D40B7 FOREIGN KEY (categorie3_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E8528116EA65534 FOREIGN KEY (categorie4_credit_id) REFERENCES categorie_credit (id)');
        $this->addSql('CREATE INDEX IDX_5E8528111FF1F976 ON demande_credit (categorie1_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E85281186139F77 ON demande_credit (categorie2_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E852811479D40B7 ON demande_credit (categorie3_credit_id)');
        $this->addSql('CREATE INDEX IDX_5E8528116EA65534 ON demande_credit (categorie4_credit_id)');
        $this->addSql('ALTER TABLE individuelclient ADD garant TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528111FF1F976');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E85281186139F77');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E852811479D40B7');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E8528116EA65534');
        $this->addSql('DROP INDEX IDX_5E8528111FF1F976 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E85281186139F77 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E852811479D40B7 ON demande_credit');
        $this->addSql('DROP INDEX IDX_5E8528116EA65534 ON demande_credit');
        $this->addSql('ALTER TABLE demande_credit ADD categorie1_credit VARCHAR(255) DEFAULT NULL, ADD categorie2_credit VARCHAR(255) DEFAULT NULL, ADD categorie3_credit VARCHAR(255) DEFAULT NULL, ADD categorie4_credit VARCHAR(255) DEFAULT NULL, DROP categorie1_credit_id, DROP categorie2_credit_id, DROP categorie3_credit_id, DROP categorie4_credit_id');
        $this->addSql('ALTER TABLE individuelclient DROP garant');
    }
}
