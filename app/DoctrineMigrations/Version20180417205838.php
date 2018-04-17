<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180417205838 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbcountry_states (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AD55A54077153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpermit_user_profile ADD stateid INT NOT NULL, DROP state');
        $this->addSql('ALTER TABLE tbpermit_user_profile ADD CONSTRAINT FK_2E7C5A7320AC4F4D FOREIGN KEY (stateid) REFERENCES tbcountry_states (id)');
        $this->addSql('CREATE INDEX IDX_2E7C5A7320AC4F4D ON tbpermit_user_profile (stateid)');
        $this->addSql('ALTER TABLE tbpermit ADD block  VARCHAR(255) NOT NULL, ADD pbpg  VARCHAR(255) NOT NULL, ADD area  NUMERIC(15, 8) NOT NULL, ADD length  NUMERIC(15, 8) NOT NULL, DROP block, DROP pbpg, DROP area, DROP length, CHANGE description_of_work description_of_work  LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbpermit_user_profile DROP FOREIGN KEY FK_2E7C5A7320AC4F4D');
        $this->addSql('DROP TABLE tbcountry_states');
        $this->addSql('ALTER TABLE tbpermit ADD block VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD pbpg VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD area NUMERIC(15, 8) NOT NULL, ADD length NUMERIC(15, 8) NOT NULL, DROP block , DROP pbpg , DROP area , DROP length , CHANGE description_of_work  description_of_work LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('DROP INDEX IDX_2E7C5A7320AC4F4D ON tbpermit_user_profile');
        $this->addSql('ALTER TABLE tbpermit_user_profile ADD state VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP stateid');
    }

    public function postUp(Schema $schema) {
        $this->connection->exec(
            'INSERT INTO tbcountry_states (code,name) 
                    values (\'AL\',\'Alabama\'),
                           (\'AK\',\'Alaska\'),
                           (\'AS\',\'American Samoa\'),
                           (\'AZ\',\'Arizona\'),
                           (\'AR\',\'Arkansas\'),
                           (\'CA\',\'California\'),
                           (\'CO\',\'Colorado\'),
                           (\'CT\',\'Connecticut\'),
                           (\'DE\',\'Delaware\'),
                           (\'DC\',\'District of Columbia\'),
                           (\'FM\',\'Federated States of Micronesia\'),
                           (\'FL\',\'Florida\'),
                           (\'GA\',\'Georgia\'),
                           (\'GU\',\'Guam\'),
                           (\'HI\',\'Hawaii\'),
                           (\'ID\',\'Idaho\'),
                           (\'IL\',\'Illinois\'),
                           (\'IN\',\'Indiana\'),
                           (\'IA\',\'Iowa\'),
                           (\'KS\',\'Kansas\'),
                           (\'KY\',\'Kentucky\'),
                           (\'LA\',\'Louisiana\'),
                           (\'ME\',\'Maine\'),
                           (\'MH\',\'Marshall Islands\'),
                           (\'MD\',\'Maryland\'),
                           (\'MA\',\'Massachusetts\'),
                           (\'MI\',\'Michigan\'),
                           (\'MN\',\'Minnesota\'),
                           (\'MS\',\'Mississippi\'),
                           (\'MO\',\'Missouri\'),
                           (\'MT\',\'Montana\'),
                           (\'NE\',\'Nebraska\'),
                           (\'NV\',\'Nevada\'),
                           (\'NH\',\'New Hampshire\'),
                           (\'NJ\',\'New Jersey\'),
                           (\'NM\',\'New Mexico\'),
                           (\'NY\',\'New York\'),
                           (\'NC\',\'North Carolina\'),
                           (\'ND\',\'North Dakota\'),
                           (\'MP\',\'Northern Mariana Islands\'),
                           (\'OH\',\'Ohio\'),
                           (\'OK\',\'Oklahoma\'),
                           (\'OR\',\'Oregon\'),
                           (\'PW\',\'Palau\'),
                           (\'PA\',\'Pennsylvania\'),
                           (\'PR\',\'Puerto Rico\'),
                           (\'RI\',\'Rhode Island\'),
                           (\'SC\',\'South Carolina\'),
                           (\'SD\',\'South Dakota\'),
                           (\'TN\',\'Tennessee\'),
                           (\'TX\',\'Texas\'),
                           (\'UT\',\'Utah\'),
                           (\'VT\',\'Vermont\'),
                           (\'VI\',\'Virgin Islands\'),
                           (\'VA\',\'Virginia\'),
                           (\'WA\',\'Washington\'),
                           (\'WV\',\'West Virginia\'),
                           (\'WI\',\'Wisconsin\'),
                           (\'WY\',\'Wyoming\')' );
    }
}
