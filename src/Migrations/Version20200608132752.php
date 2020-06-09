<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608132752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE statistiche (id INT AUTO_INCREMENT NOT NULL, titolo_evento VARCHAR(30) NOT NULL, completion_date VARCHAR(30) NOT NULL, durata INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eventi CHANGE start_date start_date VARCHAR(30) NOT NULL, CHANGE end_date end_date VARCHAR(30) NOT NULL, CHANGE completato completato TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE priorita CHANGE nome nome VARCHAR(20) NOT NULL, CHANGE colore colore VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(20) NOT NULL, CHANGE mail mail VARCHAR(30) NOT NULL, CHANGE password password VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE user_session DROP FOREIGN KEY FK_8849CBDE899DB076');
        $this->addSql('DROP INDEX IDX_8849CBDE899DB076 ON user_session');
        $this->addSql('ALTER TABLE user_session CHANGE add_date add_date VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE statistiche');
        $this->addSql('ALTER TABLE eventi CHANGE start_date start_date VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE end_date end_date VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE completato completato TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE priorita CHANGE nome nome VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci, CHANGE colore colore VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE mail mail VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_session CHANGE add_date add_date VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT FK_8849CBDE899DB076 FOREIGN KEY (fk_id_user) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8849CBDE899DB076 ON user_session (fk_id_user)');
    }
}
