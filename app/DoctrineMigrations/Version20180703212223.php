<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180703212223 extends AbstractMigration
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
    }
}
