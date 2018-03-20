<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319032545 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE permit DROP FOREIGN KEY FK_895C01F0E70B032');
        $this->addSql('CREATE TABLE tbpermit (id INT AUTO_INCREMENT NOT NULL, typeid INT NOT NULL, userid INT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_698FBD9CE70B032 (typeid), INDEX IDX_698FBD9CF132696E (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbpermit_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7443F7378CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbpermit_user (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbpermit_user_relation_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AA37FB218CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9CE70B032 FOREIGN KEY (typeid) REFERENCES tbpermit_type (id)');
        $this->addSql('ALTER TABLE tbpermit ADD CONSTRAINT FK_698FBD9CF132696E FOREIGN KEY (userid) REFERENCES tbuser (id)');
        $this->addSql('DROP TABLE permit');
        $this->addSql('DROP TABLE permit_type');
        $this->addSql('DROP TABLE permit_user');
        $this->addSql('DROP TABLE permit_user_relation_type');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit DROP FOREIGN KEY FK_698FBD9CE70B032');
        $this->addSql('CREATE TABLE permit (id INT AUTO_INCREMENT NOT NULL, typeid INT NOT NULL, userid INT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_895C01F0E70B032 (typeid), INDEX IDX_895C01F0F132696E (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permit_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_AE94E4DC8CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permit_user (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permit_user_relation_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_26B8064F8CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE permit ADD CONSTRAINT FK_895C01F0E70B032 FOREIGN KEY (typeid) REFERENCES permit_type (id)');
        $this->addSql('ALTER TABLE permit ADD CONSTRAINT FK_895C01F0F132696E FOREIGN KEY (userid) REFERENCES tbuser (id)');
        $this->addSql('DROP TABLE tbpermit');
        $this->addSql('DROP TABLE tbpermit_type');
        $this->addSql('DROP TABLE tbpermit_user');
        $this->addSql('DROP TABLE tbpermit_user_relation_type');
    }
}
