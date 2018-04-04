<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180404021034 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbpermit_improvement_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9902A7898CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbpermit_improvement_type');
    }

    public function postUp(Schema $schema) {
        $this->connection->exec(
            'INSERT INTO tbpermit_improvement_type (name,description,type) values (\'New\',\'New\',\'NEW\'), (\'Addition Attached\',\'Addition Attached\',\'ADDITION_ATTACHED\'),
                                                                      (\'Addition Detached\',\'Addition Detached\',\'ADDITION_DETACHED\'), (\'Alteration Interior\',\'Alteration Interior\',\'ALTERATION_INTERIOR\'),
                                                                      (\'Alteration Exterior\',\'Alteration Exterior\',\'ALTERATION_EXTERIOR\'), (\'Repair/Replace\',\'Repair/Replace\',\'REPAIR_REPLACE\'), (\'Demolish\',\'Demolish\',\'DEMOLISH\')'
        );
    }
}
