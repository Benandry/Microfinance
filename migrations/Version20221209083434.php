<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209083434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE approbationcredit');
        $this->addSql('ALTER TABLE garantie_credit DROP FOREIGN KEY FK_9B3499164C62D160');
        $this->addSql('DROP INDEX IDX_9B3499164C62D160 ON garantie_credit');
        $this->addSql('ALTER TABLE garantie_credit ADD produit_epargne VARCHAR(255) DEFAULT NULL, DROP produit_epargne_id');
        $this->addSql('ALTER TABLE produit_credit ADD produit_credit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit_credit ADD CONSTRAINT FK_EB93A5C44A917115 FOREIGN KEY (produit_credit_id) REFERENCES produit_credit (id)');
        $this->addSql('CREATE INDEX IDX_EB93A5C44A917115 ON produit_credit (produit_credit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approbationcredit (id INT AUTO_INCREMENT NOT NULL, dateap DATE NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, montantapprouver DOUBLE PRECISION NOT NULL, personneap VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, num_credit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE garantie_credit ADD produit_epargne_id INT DEFAULT NULL, DROP produit_epargne');
        $this->addSql('ALTER TABLE garantie_credit ADD CONSTRAINT FK_9B3499164C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
        $this->addSql('CREATE INDEX IDX_9B3499164C62D160 ON garantie_credit (produit_epargne_id)');
        $this->addSql('ALTER TABLE produit_credit DROP FOREIGN KEY FK_EB93A5C44A917115');
        $this->addSql('DROP INDEX IDX_EB93A5C44A917115 ON produit_credit');
        $this->addSql('ALTER TABLE produit_credit DROP produit_credit_id');
    }
}
