<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180608203032 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbpermit_permit_type (id INT AUTO_INCREMENT NOT NULL, typeid INT NOT NULL, permitid INT NOT NULL, description_of_work  LONGTEXT NOT NULL, estimate_value NUMERIC(15, 8) NOT NULL, area  NUMERIC(15, 8) NOT NULL, length  NUMERIC(15, 8) NOT NULL, gallons VARCHAR(255) NOT NULL, INDEX IDX_EA2DCF48E70B032 (typeid), INDEX IDX_EA2DCF48DC823F27 (permitid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD CONSTRAINT FK_EA2DCF48E70B032 FOREIGN KEY (typeid) REFERENCES tbpermit_type (id)');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD CONSTRAINT FK_EA2DCF48DC823F27 FOREIGN KEY (permitid) REFERENCES tbpermit (id)');
        $this->addSql('ALTER TABLE tbpermit DROP FOREIGN KEY FK_698FBD9CE70B032');
        $this->addSql('ALTER TABLE tbpermit DROP FOREIGN KEY FK_698FBD9CF132696E');
        $this->addSql('DROP INDEX IDX_698FBD9CE70B032 ON tbpermit');
        $this->addSql('DROP INDEX IDX_698FBD9CF132696E ON tbpermit');
        $this->addSql('ALTER TABLE tbpermit ADD block  VARCHAR(255) NOT NULL, ADD pbpg  VARCHAR(255) NOT NULL, DROP typeid, DROP userid, DROP description_of_work, DROP estimate_value, DROP block, DROP pbpg, DROP area, DROP length, DROP gallons');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbpermit_permit_type');
        $this->addSql('ALTER TABLE tbpermit ADD typeid INT NOT NULL, ADD userid INT NOT NULL, ADD description_of_work LONGTEXT NOT NULL COLLATE utf8_unicode_ci, ADD estimate_value NUMERIC(15, 8) NOT NULL, ADD block VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD pbpg VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD area NUMERIC(15, 8) NOT NULL, ADD length NUMERIC(15, 8) NOT NULL, ADD gallons VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP block , DROP pbpg ');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9CE70B032 FOREIGN KEY (typeid) REFERENCES tbpermit_type (id)');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9CF132696E FOREIGN KEY (userid) REFERENCES tbuser (id)');
        $this->addSql('CREATE INDEX IDX_698FBD9CE70B032 ON tbpermit (typeid)');
        $this->addSql('CREATE INDEX IDX_698FBD9CF132696E ON tbpermit (userid)');
    }
}
