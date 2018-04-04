<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180404014221 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    public function postUp(Schema $schema) {
        $this->connection->exec(
            'INSERT INTO tbpermit_type (name,description,type) values (\'Building\',\'Building\',\'BUILDING\'), (\'Electrical\',\'Electrical\',\'ELECTRICAL\'),
                                                                      (\'Mechanical\',\'Mechanical\',\'MECHANICAL\'), (\'Plumbing/Gas\',\'Plumbing/Gas\',\'PLUMBING_GAS\'),
                                                                      (\'Public Works\',\'Public Works\',\'PUBLIC_WORKS\'), (\'Sign\',\'Sign\',\'SIGN\'), (\'Roofing\',\'Roofing\',\'ROOFING\')'
        );
    }
}
