<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180517021309 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbcompany_fees (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, fees_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_D4FC3761979B1AD6 (company_id), INDEX IDX_D4FC37619C6BD325 (fees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbcompany_fees ADD CONSTRAINT FK_D4FC3761979B1AD6 FOREIGN KEY (company_id) REFERENCES tbcompany (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbcompany_fees ADD CONSTRAINT FK_D4FC37619C6BD325 FOREIGN KEY (fees_id) REFERENCES tbfees_item (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbcompany_fees');
    }
}
