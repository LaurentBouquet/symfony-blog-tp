<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629174449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE start_date_time_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_formation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE start_date_time (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_formation (id INT NOT NULL, speaker_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, capacity INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, description TEXT DEFAULT NULL, start_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, image_file_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5C84E2CD04A0F27 ON tbl_formation (speaker_id)');
        $this->addSql('CREATE INDEX IDX_5C84E2CB03A8386 ON tbl_formation (created_by_id)');
        $this->addSql('COMMENT ON COLUMN tbl_formation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN tbl_formation.start_date_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN tbl_formation.end_date_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE tbl_page (id INT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, text TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_user (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38B383A1E7927C74 ON tbl_user (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE tbl_formation ADD CONSTRAINT FK_5C84E2CD04A0F27 FOREIGN KEY (speaker_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_formation ADD CONSTRAINT FK_5C84E2CB03A8386 FOREIGN KEY (created_by_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE start_date_time_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_formation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_page_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_user_id_seq CASCADE');
        $this->addSql('ALTER TABLE tbl_formation DROP CONSTRAINT FK_5C84E2CD04A0F27');
        $this->addSql('ALTER TABLE tbl_formation DROP CONSTRAINT FK_5C84E2CB03A8386');
        $this->addSql('DROP TABLE start_date_time');
        $this->addSql('DROP TABLE tbl_formation');
        $this->addSql('DROP TABLE tbl_page');
        $this->addSql('DROP TABLE tbl_user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
