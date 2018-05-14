<?php declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180514194012 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD user_disabled TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE bid CHANGE rejected rejected TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE accepted accepted TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Bid CHANGE rejected rejected TINYINT(1) NOT NULL, CHANGE accepted accepted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE User DROP user_disabled');
    }
}
