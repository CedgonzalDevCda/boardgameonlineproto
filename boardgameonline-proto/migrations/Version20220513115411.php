<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513115411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, is_visible TINYINT(1) NOT NULL, name VARCHAR(100) NOT NULL, category VARCHAR(50) NOT NULL, rules VARCHAR(255) NOT NULL, rule_version VARCHAR(45) NOT NULL, min_player INT NOT NULL, max_player INT NOT NULL, age INT NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, online_version VARCHAR(45) DEFAULT NULL, favoris TINYINT(1) NOT NULL, date_creation DATETIME DEFAULT NULL, date_last_update DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_list_by_user (id INT AUTO_INCREMENT NOT NULL, games_id INT DEFAULT NULL, users_id INT DEFAULT NULL, INDEX IDX_8963669797FFC673 (games_id), INDEX IDX_8963669767B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_list_by_user ADD CONSTRAINT FK_8963669797FFC673 FOREIGN KEY (games_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_list_by_user ADD CONSTRAINT FK_8963669767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_list_by_user DROP FOREIGN KEY FK_8963669797FFC673');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_list_by_user');
    }
}
