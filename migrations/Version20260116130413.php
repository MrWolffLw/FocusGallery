<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260116130413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, title_fr, title_en, description_fr, description_en, image_name, updated_at FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title_fr VARCHAR(255) NOT NULL, title_en VARCHAR(255) NOT NULL, description_fr VARCHAR(255) NOT NULL, description_en CLOB NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, category DATETIME NOT NULL)');
        $this->addSql('INSERT INTO photo (id, title_fr, title_en, description_fr, description_en, image_name, updated_at) SELECT id, title_fr, title_en, description_fr, description_en, image_name, updated_at FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, title_fr, title_en, description_fr, description_en, image_name, updated_at FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title_fr VARCHAR(255) NOT NULL, title_en VARCHAR(255) NOT NULL, description_fr VARCHAR(255) NOT NULL, description_en CLOB NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, category_id INTEGER NOT NULL, CONSTRAINT FK_14B7841812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO photo (id, title_fr, title_en, description_fr, description_en, image_name, updated_at) SELECT id, title_fr, title_en, description_fr, description_en, image_name, updated_at FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B7841812469DE2 ON photo (category_id)');
    }
}
