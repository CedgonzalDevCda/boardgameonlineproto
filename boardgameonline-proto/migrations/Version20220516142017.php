<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516142017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friend (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE friends_list (id INT AUTO_INCREMENT NOT NULL, friends_id INT DEFAULT NULL, users_id INT DEFAULT NULL, INDEX IDX_C913D5EA49CA8337 (friends_id), INDEX IDX_C913D5EA67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friends_list ADD CONSTRAINT FK_C913D5EA49CA8337 FOREIGN KEY (friends_id) REFERENCES friend (id)');
        $this->addSql('ALTER TABLE friends_list ADD CONSTRAINT FK_C913D5EA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friends_list DROP FOREIGN KEY FK_C913D5EA49CA8337');
        $this->addSql('DROP TABLE friend');
        $this->addSql('DROP TABLE friends_list');
    }
}
