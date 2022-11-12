<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102134541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benutzer ADD log_id INT NOT NULL');
        $this->addSql('ALTER TABLE benutzer ADD CONSTRAINT FK_36144FC7EA675D86 FOREIGN KEY (log_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_36144FC7EA675D86 ON benutzer (log_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benutzer DROP FOREIGN KEY FK_36144FC7EA675D86');
        $this->addSql('DROP INDEX IDX_36144FC7EA675D86 ON benutzer');
        $this->addSql('ALTER TABLE benutzer DROP log_id');
    }
}
