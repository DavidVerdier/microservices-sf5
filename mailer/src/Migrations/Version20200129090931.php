<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129090931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE to_emails (id INT AUTO_INCREMENT NOT NULL, mail_id INT NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, INDEX IDX_6A53E4CFC8776F01 (mail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mails (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, from_email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, sent_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE to_emails ADD CONSTRAINT FK_6A53E4CFC8776F01 FOREIGN KEY (mail_id) REFERENCES mails (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE to_emails DROP FOREIGN KEY FK_6A53E4CFC8776F01');
        $this->addSql('DROP TABLE to_emails');
        $this->addSql('DROP TABLE mails');
    }
}
