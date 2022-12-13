<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221213113119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fond_credit ADD devise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fond_credit ADD CONSTRAINT FK_4B94101EF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('CREATE INDEX IDX_4B94101EF4445056 ON fond_credit (devise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fond_credit DROP FOREIGN KEY FK_4B94101EF4445056');
        $this->addSql('DROP INDEX IDX_4B94101EF4445056 ON fond_credit');
        $this->addSql('ALTER TABLE fond_credit DROP devise_id');
    }
}
