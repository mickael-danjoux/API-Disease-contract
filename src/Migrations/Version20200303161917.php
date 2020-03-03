<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303161917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE person (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, first_name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, gender BOOLEAN NOT NULL, birth_date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_34DCD1768BAC62AF ON person (city_id)');
        $this->addSql('CREATE TABLE city (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE contracted_disease (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, disease_id INTEGER NOT NULL, contracted_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_AB91DAB4D8355341 ON contracted_disease (disease_id)');
        $this->addSql('CREATE TABLE contracted_disease_person (contracted_disease_id INTEGER NOT NULL, person_id INTEGER NOT NULL, PRIMARY KEY(contracted_disease_id, person_id))');
        $this->addSql('CREATE INDEX IDX_DC7CF2AB58C91D10 ON contracted_disease_person (contracted_disease_id)');
        $this->addSql('CREATE INDEX IDX_DC7CF2AB217BBB47 ON contracted_disease_person (person_id)');
        $this->addSql('CREATE TABLE disease (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE contracted_disease');
        $this->addSql('DROP TABLE contracted_disease_person');
        $this->addSql('DROP TABLE disease');
    }
}
