<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507124713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE eventi (id INT AUTO_INCREMENT NOT NULL, fk_id_utente_id INT NOT NULL, fk_id_progetto_id INT NOT NULL, start_date LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', titolo VARCHAR(30) NOT NULL, priorita INT NOT NULL, INDEX IDX_AEE5AE30A715E314 (fk_id_utente_id), INDEX IDX_AEE5AE30ECDBE49E (fk_id_progetto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progetti (id INT AUTO_INCREMENT NOT NULL, titolo VARCHAR(30) NOT NULL, start_date LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eventi ADD CONSTRAINT FK_AEE5AE30A715E314 FOREIGN KEY (fk_id_utente_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE eventi ADD CONSTRAINT FK_AEE5AE30ECDBE49E FOREIGN KEY (fk_id_progetto_id) REFERENCES progetti (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eventi DROP FOREIGN KEY FK_AEE5AE30ECDBE49E');
        $this->addSql('DROP TABLE eventi');
        $this->addSql('DROP TABLE progetti');
    }
}
