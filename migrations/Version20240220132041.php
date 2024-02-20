<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220132041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE badge_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE badge_reader_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE key_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE registration_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE badge (id INT NOT NULL, key_id INT DEFAULT NULL, serial_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEF0481DD145533 ON badge (key_id)');
        $this->addSql('CREATE TABLE badge_reader (id INT NOT NULL, serial_number VARCHAR(255) NOT NULL, system_version VARCHAR(255) NOT NULL, model_name VARCHAR(255) NOT NULL, system_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE key (id INT NOT NULL, passphrase VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE key_badge_reader (key_id INT NOT NULL, badge_reader_id INT NOT NULL, PRIMARY KEY(key_id, badge_reader_id))');
        $this->addSql('CREATE INDEX IDX_110D5450D145533 ON key_badge_reader (key_id)');
        $this->addSql('CREATE INDEX IDX_110D545026BB88A3 ON key_badge_reader (badge_reader_id)');
        $this->addSql('CREATE TABLE registration (id INT NOT NULL, badge_id INT NOT NULL, badge_reader_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62A8A7A7F7A2C2FC ON registration (badge_id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A726BB88A3 ON registration (badge_reader_id)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DD145533 FOREIGN KEY (key_id) REFERENCES key (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE key_badge_reader ADD CONSTRAINT FK_110D5450D145533 FOREIGN KEY (key_id) REFERENCES key (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE key_badge_reader ADD CONSTRAINT FK_110D545026BB88A3 FOREIGN KEY (badge_reader_id) REFERENCES badge_reader (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A726BB88A3 FOREIGN KEY (badge_reader_id) REFERENCES badge_reader (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE badge_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE badge_reader_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE key_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE registration_id_seq CASCADE');
        $this->addSql('ALTER TABLE badge DROP CONSTRAINT FK_FEF0481DD145533');
        $this->addSql('ALTER TABLE key_badge_reader DROP CONSTRAINT FK_110D5450D145533');
        $this->addSql('ALTER TABLE key_badge_reader DROP CONSTRAINT FK_110D545026BB88A3');
        $this->addSql('ALTER TABLE registration DROP CONSTRAINT FK_62A8A7A7F7A2C2FC');
        $this->addSql('ALTER TABLE registration DROP CONSTRAINT FK_62A8A7A726BB88A3');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE badge_reader');
        $this->addSql('DROP TABLE key');
        $this->addSql('DROP TABLE key_badge_reader');
        $this->addSql('DROP TABLE registration');
    }
}
