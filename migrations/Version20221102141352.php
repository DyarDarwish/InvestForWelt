<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102141352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benutzer ADD CONSTRAINT FK_36144FC740A53BF6 FOREIGN KEY (rolle_id) REFERENCES rolle (id)');
        $this->addSql('ALTER TABLE benutzer ADD CONSTRAINT FK_36144FC77BA06AF4 FOREIGN KEY (plz_id) REFERENCES plz (id)');
        $this->addSql('CREATE INDEX IDX_36144FC740A53BF6 ON benutzer (rolle_id)');
        $this->addSql('CREATE INDEX IDX_36144FC77BA06AF4 ON benutzer (plz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benutzer DROP FOREIGN KEY FK_36144FC740A53BF6');
        $this->addSql('ALTER TABLE benutzer DROP FOREIGN KEY FK_36144FC77BA06AF4');
        $this->addSql('DROP INDEX IDX_36144FC740A53BF6 ON benutzer');
        $this->addSql('DROP INDEX IDX_36144FC77BA06AF4 ON benutzer');
    }
}
