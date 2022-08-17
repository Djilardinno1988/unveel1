<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220811154802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_user (ulid VARCHAR(26) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_421A9847E7927C74 ON users_user (email)');
        $this->addSql('CREATE TABLE users_user_points (ulid VARCHAR(26) NOT NULL, user_id VARCHAR(26) DEFAULT NULL, point INT NOT NULL, type VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_booster BOOLEAN NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE INDEX IDX_B55DA9E6A76ED395 ON users_user_points (user_id)');
        $this->addSql('ALTER TABLE users_user_points ADD CONSTRAINT FK_B55DA9E6A76ED395 FOREIGN KEY (user_id) REFERENCES users_user (ulid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users_user_points DROP CONSTRAINT FK_B55DA9E6A76ED395');
        $this->addSql('DROP TABLE users_user');
        $this->addSql('DROP TABLE users_user_points');
    }
}
