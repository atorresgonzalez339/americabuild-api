<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180420161739 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tblocation (id INT AUTO_INCREMENT NOT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL, zoom NUMERIC(10, 7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpermit_user_profile ADD locationid INT NOT NULL');
        $this->addSql('ALTER TABLE tbpermit_user_profile ADD CONSTRAINT FK_2E7C5A733530CCF FOREIGN KEY (locationid) REFERENCES tblocation (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E7C5A733530CCF ON tbpermit_user_profile (locationid)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit_user_profile DROP FOREIGN KEY FK_2E7C5A733530CCF');
        $this->addSql('DROP TABLE tblocation');
        $this->addSql('DROP INDEX UNIQ_2E7C5A733530CCF ON tbpermit_user_profile');
        $this->addSql('ALTER TABLE tbpermit_user_profile DROP locationid');
    }
}
