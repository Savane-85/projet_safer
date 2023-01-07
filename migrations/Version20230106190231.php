<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106190231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DDBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_1F9004DDBCF5E72D ON biens (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DDBCF5E72D');
        $this->addSql('DROP INDEX IDX_1F9004DDBCF5E72D ON biens');
        $this->addSql('ALTER TABLE biens DROP categorie_id');
    }
}
