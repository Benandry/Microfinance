<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110080430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE approbationcredit');
        $this->addSql('ALTER TABLE individuelclient ADD agence_id INT DEFAULT NULL, ADD commune_id INT DEFAULT NULL, DROP commune, DROP agence');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69F131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('CREATE INDEX IDX_9B96C69FD725330D ON individuelclient (agence_id)');
        $this->addSql('CREATE INDEX IDX_9B96C69F131A4F72 ON individuelclient (commune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approbationcredit (id INT AUTO_INCREMENT NOT NULL, dateap DATE NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, montantapprouver DOUBLE PRECISION NOT NULL, personneap VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, num_credit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FD725330D');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69F131A4F72');
        $this->addSql('DROP INDEX IDX_9B96C69FD725330D ON individuelclient');
        $this->addSql('DROP INDEX IDX_9B96C69F131A4F72 ON individuelclient');
        $this->addSql('ALTER TABLE individuelclient ADD commune VARCHAR(255) NOT NULL, ADD agence VARCHAR(255) NOT NULL, DROP agence_id, DROP commune_id');
    }
}
