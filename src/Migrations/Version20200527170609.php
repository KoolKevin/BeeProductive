<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527170609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE priorita (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(20) NOT NULL, colore VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eventi CHANGE start_date start_date VARCHAR(30) NOT NULL, CHANGE end_date end_date VARCHAR(30) NOT NULL, CHANGE completato completato TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(20) NOT NULL, CHANGE mail mail VARCHAR(30) NOT NULL, CHANGE password password VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE user_session CHANGE add_date add_date DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE priorita');
        $this->addSql('ALTER TABLE eventi CHANGE start_date start_date VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE end_date end_date VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE completato completato TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE mail mail VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_session CHANGE add_date add_date DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
