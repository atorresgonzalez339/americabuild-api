<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180524200114 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbpermit_fees (id INT AUTO_INCREMENT NOT NULL, company_fees_id INT NOT NULL, permit_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, permitFeesValue DOUBLE PRECISION NOT NULL, INDEX IDX_580E6172BC39C9F2 (company_fees_id), INDEX IDX_580E6172A8439AF7 (permit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpermit_fees ADD CONSTRAINT FK_580E6172BC39C9F2 FOREIGN KEY (company_fees_id) REFERENCES tbcompany_fees (id)');
        $this->addSql('ALTER TABLE tbpermit_fees ADD CONSTRAINT FK_580E6172A8439AF7 FOREIGN KEY (permit_id) REFERENCES tbpermit (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbpermit_fees');
    }
}
