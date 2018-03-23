<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180323011628 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit_user ADD userid INT DEFAULT NULL, ADD permitid INT DEFAULT NULL, ADD permiturtid INT DEFAULT NULL, ADD permituserpid INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbpermit_user ADD CONSTRAINT FK_750E7657F132696E FOREIGN KEY (userid) REFERENCES tbuser (id)');
        $this->addSql('ALTER TABLE tbpermit_user ADD CONSTRAINT FK_750E7657DC823F27 FOREIGN KEY (permitid) REFERENCES tbpermit (id)');
        $this->addSql('ALTER TABLE tbpermit_user ADD CONSTRAINT FK_750E7657E4518678 FOREIGN KEY (permiturtid) REFERENCES tbpermit_user_relation_type (id)');
        $this->addSql('ALTER TABLE tbpermit_user ADD CONSTRAINT FK_750E765756EFE04F FOREIGN KEY (permituserpid) REFERENCES tbpermit_user_profile (id)');
        $this->addSql('CREATE INDEX IDX_750E7657F132696E ON tbpermit_user (userid)');
        $this->addSql('CREATE INDEX IDX_750E7657DC823F27 ON tbpermit_user (permitid)');
        $this->addSql('CREATE INDEX IDX_750E7657E4518678 ON tbpermit_user (permiturtid)');
        $this->addSql('CREATE INDEX IDX_750E765756EFE04F ON tbpermit_user (permituserpid)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit_user DROP FOREIGN KEY FK_750E7657F132696E');
        $this->addSql('ALTER TABLE tbpermit_user DROP FOREIGN KEY FK_750E7657DC823F27');
        $this->addSql('ALTER TABLE tbpermit_user DROP FOREIGN KEY FK_750E7657E4518678');
        $this->addSql('ALTER TABLE tbpermit_user DROP FOREIGN KEY FK_750E765756EFE04F');
        $this->addSql('DROP INDEX IDX_750E7657F132696E ON tbpermit_user');
        $this->addSql('DROP INDEX IDX_750E7657DC823F27 ON tbpermit_user');
        $this->addSql('DROP INDEX IDX_750E7657E4518678 ON tbpermit_user');
        $this->addSql('DROP INDEX IDX_750E765756EFE04F ON tbpermit_user');
        $this->addSql('ALTER TABLE tbpermit_user DROP userid, DROP permitid, DROP permiturtid, DROP permituserpid');
    }
}
