<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210903032751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE query_mfc CHANGE id_status status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE query_mfc ADD CONSTRAINT FK_BABAAABE6BF700BD FOREIGN KEY (status_id) REFERENCES status_mfc (id)');
        $this->addSql('CREATE INDEX IDX_BABAAABE6BF700BD ON query_mfc (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE query_mfc DROP FOREIGN KEY FK_BABAAABE6BF700BD');
        $this->addSql('DROP INDEX IDX_BABAAABE6BF700BD ON query_mfc');
        $this->addSql('ALTER TABLE query_mfc CHANGE status_id id_status INT DEFAULT NULL');
    }
}
