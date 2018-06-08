<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180608023759 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbuser_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_3B8F96DDA76ED395 (user_id), INDEX IDX_3B8F96DDD60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbuser_role ADD CONSTRAINT FK_3B8F96DDA76ED395 FOREIGN KEY (user_id) REFERENCES tbuser (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbuser_role ADD CONSTRAINT FK_3B8F96DDD60322AC FOREIGN KEY (role_id) REFERENCES tbrol (id)');
        $this->addSql('ALTER TABLE tbuser DROP FOREIGN KEY FK_6E54C30C84A67BCA');
        $this->addSql('DROP INDEX IDX_6E54C30C84A67BCA ON tbuser');
        $this->addSql('ALTER TABLE tbuser DROP idrole');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbuser_role');
        $this->addSql('ALTER TABLE tbuser ADD idrole INT NOT NULL');
        $this->addSql('ALTER TABLE tbuser ADD CONSTRAINT FK_6E54C30C84A67BCA FOREIGN KEY (idrole) REFERENCES tbrol (id)');
        $this->addSql('CREATE INDEX IDX_6E54C30C84A67BCA ON tbuser (idrole)');
    }
}
