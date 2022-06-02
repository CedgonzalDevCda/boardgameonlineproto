<?php
//
//declare(strict_types=1);
//
//namespace DoctrineMigrations;
//
//use Doctrine\DBAL\Schema\Schema;
//use Doctrine\Migrations\AbstractMigration;
//
///**
// * Auto-generated Migration: Please modify to your needs!
// */
//final class Version20220518124356 extends AbstractMigration
//{
//    public function getDescription(): string
//    {
//        return '';
//    }
//
//    public function up(Schema $schema): void
//    {
//        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE gameroom (id INT AUTO_INCREMENT NOT NULL, games_id INT DEFAULT NULL, nb_player INT NOT NULL, date_invit DATETIME DEFAULT NULL, hash_invit VARCHAR(255) DEFAULT NULL, hash_timeout DATETIME NOT NULL, leader VARCHAR(255) NOT NULL, INDEX IDX_24AE5BA497FFC673 (games_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE gameroom ADD CONSTRAINT FK_24AE5BA497FFC673 FOREIGN KEY (games_id) REFERENCES game (id)');
//    }
//
//    public function down(Schema $schema): void
//    {
//        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('DROP TABLE gameroom');
//    }
//}
