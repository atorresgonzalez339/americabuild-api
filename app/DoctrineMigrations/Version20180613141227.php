<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180613141227 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit ADD userid INT NOT NULL, ADD block  VARCHAR(255) NOT NULL, ADD pbpg  VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9CF132696E FOREIGN KEY (userid) REFERENCES tbuser (id)');
        $this->addSql('CREATE INDEX IDX_698FBD9CF132696E ON tbpermit (userid)');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD area  NUMERIC(15, 8) NOT NULL, ADD length  NUMERIC(15, 8) NOT NULL, DROP area, DROP length, CHANGE description_of_work description_of_work  LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit DROP FOREIGN KEY FK_698FBD9CF132696E');
        $this->addSql('DROP INDEX IDX_698FBD9CF132696E ON tbpermit');
        $this->addSql('ALTER TABLE tbpermit ADD block VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD pbpg VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP userid, DROP block , DROP pbpg ');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD area NUMERIC(15, 8) NOT NULL, ADD length NUMERIC(15, 8) NOT NULL, DROP area , DROP length , CHANGE description_of_work  description_of_work LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
