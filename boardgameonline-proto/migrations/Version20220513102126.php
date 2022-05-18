<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513102126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, is_visible TINYINT(1) NOT NULL, name VARCHAR(100) NOT NULL, category VARCHAR(50) NOT NULL, rules VARCHAR(255) NOT NULL, rule_version VARCHAR(45) NOT NULL, min_player INT NOT NULL, max_player INT NOT NULL, age INT NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, online_version VARCHAR(45) DEFAULT NULL, favoris TINYINT(1) NOT NULL, date_creation DATETIME DEFAULT NULL, date_last_update DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE game');
    }
}
