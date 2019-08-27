<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 */
final class Version20190827081333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added EntityA + EntityB + some initial test data for bug reproducer';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entity_as (id INT AUTO_INCREMENT NOT NULL, entity_c_id INT DEFAULT NULL, entity_b_id INT DEFAULT NULL, something VARCHAR(1000) NOT NULL, INDEX IDX_CA2F7292D91B22F8 (entity_c_id), INDEX IDX_CA2F729261A7459D (entity_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_bs (id INT AUTO_INCREMENT NOT NULL, entity_c_id INT DEFAULT NULL, label VARCHAR(1000) NOT NULL, INDEX IDX_E1022151D91B22F8 (entity_c_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_cs (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entity_as ADD CONSTRAINT FK_CA2F7292D91B22F8 FOREIGN KEY (entity_c_id) REFERENCES entity_cs (id)');
        $this->addSql('ALTER TABLE entity_as ADD CONSTRAINT FK_CA2F729261A7459D FOREIGN KEY (entity_b_id) REFERENCES entity_bs (id)');
        $this->addSql('ALTER TABLE entity_bs ADD CONSTRAINT FK_E1022151D91B22F8 FOREIGN KEY (entity_c_id) REFERENCES entity_cs (id)');

        // Some test data for you to work on :)
        $this->addSql("INSERT INTO `entity_cs` (`id`) VALUES (1), (2)");
        $this->addSql("INSERT INTO `entity_bs` (`id`, `entity_c_id`, `label`) VALUES (1,1,'I\'m being displayed in EntityAForm\'s dropdown'), (2,1,'I\'m being pre-selected in WorkingEntityAForm\'s dropdown, I\'m broken in BrokenEntityAForm\'s dropdown'), (3,2,'I\'m totally unrelated and only here for the sake of filtering in our form')");
        $this->addSql("INSERT INTO `entity_as` (`id`, `entity_c_id`, `entity_b_id`, `something`) VALUES (1,1,2,'Something something, something!'), (2,2,1,'I\'m also totally unrelated')");
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entity_as DROP FOREIGN KEY FK_CA2F729261A7459D');
        $this->addSql('ALTER TABLE entity_as DROP FOREIGN KEY FK_CA2F7292D91B22F8');
        $this->addSql('ALTER TABLE entity_bs DROP FOREIGN KEY FK_E1022151D91B22F8');
        $this->addSql('DROP TABLE entity_as');
        $this->addSql('DROP TABLE entity_bs');
        $this->addSql('DROP TABLE entity_cs');
    }
}
