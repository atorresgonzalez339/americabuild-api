<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180702225206 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbpermit_revision (id INT AUTO_INCREMENT NOT NULL, permit_id INT NOT NULL, revision_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_7354E679A8439AF7 (permit_id), INDEX IDX_7354E6791DFA7C8F (revision_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbrevision (id INT AUTO_INCREMENT NOT NULL, permit_type_id INT NOT NULL, name LONGTEXT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_66FC2E132FA2687F (permit_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpermit_revision ADD CONSTRAINT FK_7354E679A8439AF7 FOREIGN KEY (permit_id) REFERENCES tbpermit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbpermit_revision ADD CONSTRAINT FK_7354E6791DFA7C8F FOREIGN KEY (revision_id) REFERENCES tbrevision (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbrevision ADD CONSTRAINT FK_66FC2E132FA2687F FOREIGN KEY (permit_type_id) REFERENCES tbpermit_type (id)');
        $this->addSql('ALTER TABLE tbpermit ADD block  VARCHAR(255) NOT NULL, ADD pbpg  VARCHAR(255) NOT NULL, DROP block, DROP pbpg');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9CF132696E FOREIGN KEY (userid) REFERENCES tbuser (id)');
        $this->addSql('CREATE INDEX IDX_698FBD9CF132696E ON tbpermit (userid)');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD area  NUMERIC(15, 8) NOT NULL, ADD length  NUMERIC(15, 8) NOT NULL, DROP area, DROP length, CHANGE description_of_work description_of_work  LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit_revision DROP FOREIGN KEY FK_7354E6791DFA7C8F');
        $this->addSql('DROP TABLE tbpermit_revision');
        $this->addSql('DROP TABLE tbrevision');
        $this->addSql('ALTER TABLE tbpermit DROP FOREIGN KEY FK_698FBD9CF132696E');
        $this->addSql('DROP INDEX IDX_698FBD9CF132696E ON tbpermit');
        $this->addSql('ALTER TABLE tbpermit ADD block VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD pbpg VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP block , DROP pbpg ');
        $this->addSql('ALTER TABLE tbpermit_permit_type ADD area NUMERIC(15, 8) NOT NULL, ADD length NUMERIC(15, 8) NOT NULL, DROP area , DROP length , CHANGE description_of_work  description_of_work LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
