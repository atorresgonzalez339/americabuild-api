<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180409190915 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit ADD improvementid INT NOT NULL, ADD folio_number VARCHAR(255) NOT NULL, ADD number_of_units INT NOT NULL, ADD lot VARCHAR(255) NOT NULL, ADD block  VARCHAR(255) NOT NULL, ADD subdivision VARCHAR(255) NOT NULL, ADD pbpg  VARCHAR(255) NOT NULL, ADD current_use_of_property VARCHAR(255) NOT NULL, ADD description_of_work  LONGTEXT NOT NULL, ADD estimate_value NUMERIC(15, 0) NOT NULL, ADD area  NUMERIC(15, 0) NOT NULL, ADD length  NUMERIC(15, 0) NOT NULL');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9C9F43980E FOREIGN KEY (improvementid) REFERENCES tbpermit_improvement_type (id)');
        $this->addSql('CREATE INDEX IDX_698FBD9C9F43980E ON tbpermit (improvementid)');
        $this->addSql('ALTER TABLE tbpermit_user DROP FOREIGN KEY FK_750E7657DC823F27');
        $this->addSql('ALTER TABLE tbpermit_user ADD CONSTRAINT FK_750E7657DC823F27 FOREIGN KEY (permitid) REFERENCES tbpermit (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit DROP FOREIGN KEY FK_698FBD9C9F43980E');
        $this->addSql('DROP INDEX IDX_698FBD9C9F43980E ON tbpermit');
        $this->addSql('ALTER TABLE tbpermit DROP improvementid, DROP folio_number, DROP number_of_units, DROP lot, DROP block , DROP subdivision, DROP pbpg , DROP current_use_of_property, DROP description_of_work , DROP estimate_value, DROP area , DROP length ');
        $this->addSql('ALTER TABLE tbpermit_user DROP FOREIGN KEY FK_750E7657DC823F27');
        $this->addSql('ALTER TABLE tbpermit_user ADD CONSTRAINT FK_750E7657DC823F27 FOREIGN KEY (permitid) REFERENCES tbpermit (id)');
    }
}
