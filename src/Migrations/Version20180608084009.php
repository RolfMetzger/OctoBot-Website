<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180608084009 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tbl_package_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_package_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tbl_package_category (id INT NOT NULL, shortname VARCHAR(15) NOT NULL, longname VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_package (id INT NOT NULL, category_id INT NOT NULL, vendor VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, version VARCHAR(25) NOT NULL, description TEXT DEFAULT NULL, repository VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_853B6FE112469DE2 ON tbl_package (category_id)');
        $this->addSql('CREATE TABLE tbl_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, is_active BOOLEAN NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38B383A1F85E0677 ON tbl_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38B383A1E7927C74 ON tbl_user (email)');
        $this->addSql('COMMENT ON COLUMN tbl_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE tbl_package ADD CONSTRAINT FK_853B6FE112469DE2 FOREIGN KEY (category_id) REFERENCES tbl_package_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tbl_package DROP CONSTRAINT FK_853B6FE112469DE2');
        $this->addSql('DROP SEQUENCE tbl_package_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_package_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_user_id_seq CASCADE');
        $this->addSql('DROP TABLE tbl_package_category');
        $this->addSql('DROP TABLE tbl_package');
        $this->addSql('DROP TABLE tbl_user');
    }
}
