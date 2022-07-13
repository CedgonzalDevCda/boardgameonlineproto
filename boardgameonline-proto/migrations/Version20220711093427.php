<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711093427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survey ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survey ADD CONSTRAINT FK_AD5F9BFC99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_AD5F9BFC99E6F5DF ON survey (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survey DROP FOREIGN KEY FK_AD5F9BFC99E6F5DF');
        $this->addSql('DROP INDEX IDX_AD5F9BFC99E6F5DF ON survey');
        $this->addSql('ALTER TABLE survey DROP player_id');
    }
}
