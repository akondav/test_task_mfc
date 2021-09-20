<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210903041415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE changes_mfc ADD query_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE changes_mfc ADD CONSTRAINT FK_72DFEFE6EF946F99 FOREIGN KEY (query_id) REFERENCES query_mfc (id)');
        $this->addSql('CREATE INDEX IDX_72DFEFE6EF946F99 ON changes_mfc (query_id)');
        $this->addSql('ALTER TABLE images_mfc ADD query_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images_mfc ADD CONSTRAINT FK_E3324CC3EF946F99 FOREIGN KEY (query_id) REFERENCES query_mfc (id)');
        $this->addSql('CREATE INDEX IDX_E3324CC3EF946F99 ON images_mfc (query_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE changes_mfc DROP FOREIGN KEY FK_72DFEFE6EF946F99');
        $this->addSql('DROP INDEX IDX_72DFEFE6EF946F99 ON changes_mfc');
        $this->addSql('ALTER TABLE changes_mfc DROP query_id');
        $this->addSql('ALTER TABLE images_mfc DROP FOREIGN KEY FK_E3324CC3EF946F99');
        $this->addSql('DROP INDEX IDX_E3324CC3EF946F99 ON images_mfc');
        $this->addSql('ALTER TABLE images_mfc DROP query_id');
    }
}
