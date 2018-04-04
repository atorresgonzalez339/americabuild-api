<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180404020129 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbpermit_change_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_ABB035068CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbpermit_change_type');
    }

    public function postUp(Schema $schema) {
        $this->connection->exec(
            'INSERT INTO tbpermit_change_type (name,description,type) values (\'Change Contractor\',\'Change Contractor\',\'CHANGE_CONTRACTOR\'), (\'Extension\',\'Extension\',\'EXTENSION\'),
                                                                      (\'Renewal\',\'Renewal\',\'RENEWAL\'), (\'Shop Drawing\',\'Shop Drawing\',\'SHOP_DRAWING\'),
                                                                      (\'Permit Supplement\',\'Permit Supplement\',\'PERMIT_SUPPLEMENT\'), (\'Lost Plans\',\'Lost Plans\',\'LOST_PLANS\'), (\'Other\',\'Other\',\'OTHERS\')'
        );
    }
}
