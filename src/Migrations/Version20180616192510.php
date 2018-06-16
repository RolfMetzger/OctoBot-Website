<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616192510 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER SEQUENCE tbl_package_category_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_package_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_user_id_seq INCREMENT BY 1');
        $this->addSql('ALTER TABLE tbl_package_category ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_package_category ADD CONSTRAINT FK_E8130FDD727ACA70 FOREIGN KEY (parent_id) REFERENCES tbl_package_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E8130FDD727ACA70 ON tbl_package_category (parent_id)');
        $this->addSql('ALTER TABLE tbl_package ALTER owner_id SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE tbl_package_category_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_package_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tbl_user_id_seq INCREMENT BY 1');
        $this->addSql('ALTER TABLE tbl_package_category DROP CONSTRAINT FK_E8130FDD727ACA70');
        $this->addSql('DROP INDEX IDX_E8130FDD727ACA70');
        $this->addSql('ALTER TABLE tbl_package_category DROP parent_id');
        $this->addSql('ALTER TABLE tbl_package ALTER owner_id DROP NOT NULL');
    }
}
