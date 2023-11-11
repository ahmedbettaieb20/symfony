<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010152616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author ADD books_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C87DD8AC20 FOREIGN KEY (books_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_BDAFD8C87DD8AC20 ON author (books_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C87DD8AC20');
        $this->addSql('DROP INDEX IDX_BDAFD8C87DD8AC20 ON author');
        $this->addSql('ALTER TABLE author DROP books_id');
    }
}
