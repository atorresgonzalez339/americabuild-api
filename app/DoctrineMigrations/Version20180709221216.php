<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180709221216 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit ADD block  VARCHAR(255) NOT NULL, ADD pbpg  VARCHAR(255) NOT NULL, DROP block, DROP pbpg');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD area  NUMERIC(15, 8) NOT NULL, ADD length  NUMERIC(15, 8) NOT NULL, DROP area, DROP length, CHANGE description_of_work description_of_work  LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tbpermit_revision DROP FOREIGN KEY FK_7354E679A8439AF7');
        $this->addSql('DROP INDEX IDX_7354E679A8439AF7 ON tbpermit_revision');
        $this->addSql('ALTER TABLE tbpermit_revision CHANGE permit_id permitpermittype_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbpermit_revision ADD CONSTRAINT FK_7354E679EE53C640 FOREIGN KEY (permitpermittype_id) REFERENCES tbpermit_permit_type (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7354E679EE53C640 ON tbpermit_revision (permitpermittype_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit ADD block VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD pbpg VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP block , DROP pbpg ');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD area NUMERIC(15, 8) NOT NULL, ADD length NUMERIC(15, 8) NOT NULL, DROP area , DROP length , CHANGE description_of_work  description_of_work LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE tbpermit_revision DROP FOREIGN KEY FK_7354E679EE53C640');
        $this->addSql('DROP INDEX IDX_7354E679EE53C640 ON tbpermit_revision');
        $this->addSql('ALTER TABLE tbpermit_revision CHANGE permitpermittype_id permit_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbpermit_revision ADD CONSTRAINT FK_7354E679A8439AF7 FOREIGN KEY (permit_id) REFERENCES tbpermit (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7354E679A8439AF7 ON tbpermit_revision (permit_id)');
    }
}
