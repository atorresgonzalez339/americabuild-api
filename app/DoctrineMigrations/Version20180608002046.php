<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180608002046 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->connection->exec(
            'INSERT INTO tbpermit_user_relation_type (name,description,type)
                    values (\'Tenant\',\'Permit Tenant\',\'TENANT\'), (\'Architect\',\'Permit Architect\',\'ARCHITECT\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->connection->exec(
            'DELETE FROM tbpermit_user_relation_type WHERE name IN (\'Tenant\',\'Architect\')');
    }
}
