<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180430184921 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbuser_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E0384B9E8CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbuser ADD idusertype INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbuser ADD CONSTRAINT FK_6E54C30C80766755 FOREIGN KEY (idusertype) REFERENCES tbuser_type (id)');
        $this->addSql('CREATE INDEX IDX_6E54C30C80766755 ON tbuser (idusertype)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbuser DROP FOREIGN KEY FK_6E54C30C80766755');
        $this->addSql('DROP TABLE tbuser_type');
        $this->addSql('DROP INDEX IDX_6E54C30C80766755 ON tbuser');
        $this->addSql('ALTER TABLE tbuser DROP idusertype');
    }

    public function postUp(Schema $schema) {
        $this->connection->exec(
            'INSERT INTO tbuser_type (name,description,type)
                    values (\'Owner / Tenant\',\'Owner / Tenant\',\'OWNER_TENANT\'),
                           (\'Contractor\',\'Contractor\',\'CONTRACTOR\'),
                           (\'Architect\',\'Architect\',\'ARCHITECT\')');
    }
}
