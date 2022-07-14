<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714085326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE email_change_request (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, verification_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD email_change_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3898AB5 FOREIGN KEY (email_change_request_id) REFERENCES email_change_request (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C3898AB5 ON user (email_change_request_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649C3898AB5');
        $this->addSql('DROP TABLE email_change_request');
        $this->addSql('DROP INDEX UNIQ_8D93D649C3898AB5 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP email_change_request_id');
    }
}
