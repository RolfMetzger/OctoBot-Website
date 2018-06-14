<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180614154835 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER SEQUENCE tbl_package_category_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_package_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_user_id_seq INCREMENT BY 1');
        $this->addSql('ALTER TABLE tbl_package ADD owner_id INT');
        $this->addSql('UPDATE tbl_package SET owner_id = owner');
        $this->addSql('ALTER TABLE tbl_package DROP owner');
        $this->addSql('ALTER TABLE tbl_package ADD CONSTRAINT FK_853B6FE17E3C61F9 FOREIGN KEY (owner_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_853B6FE17E3C61F9 ON tbl_package (owner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE tbl_package_category_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_package_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_user_id_seq INCREMENT BY 1');
        $this->addSql('ALTER TABLE tbl_package DROP CONSTRAINT FK_853B6FE17E3C61F9');
        $this->addSql('DROP INDEX IDX_853B6FE17E3C61F9');
        $this->addSql('ALTER TABLE tbl_package ADD owner INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE tbl_package DROP owner_id');
    }
}
