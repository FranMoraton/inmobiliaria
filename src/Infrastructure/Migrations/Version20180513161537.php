<?php declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180513161537 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Bid (id INT AUTO_INCREMENT NOT NULL, user_bidding_id INT NOT NULL, house_id INT NOT NULL, money_bidded INT NOT NULL, rejected TINYINT(1) NOT NULL, accepted TINYINT(1) NOT NULL, bidding_date DATE NOT NULL, INDEX IDX_72BFF5137C6FCFB9 (user_bidding_id), INDEX IDX_72BFF5136BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordinates (id INT AUTO_INCREMENT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE House (id INT AUTO_INCREMENT NOT NULL, coordinates_id INT NOT NULL, house_owner_id INT NOT NULL, adress VARCHAR(100) NOT NULL, city VARCHAR(20) NOT NULL, country VARCHAR(20) NOT NULL, selling_prize INT NOT NULL, house_disabled TINYINT(1) NOT NULL, INDEX IDX_A6141699158B0682 (coordinates_id), INDEX IDX_A61416991DAEDAA6 (house_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, house_id INT NOT NULL, url_photo VARCHAR(255) NOT NULL, INDEX IDX_14B784186BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, dni VARCHAR(10) NOT NULL, photo VARCHAR(255) DEFAULT NULL, password VARCHAR(20) NOT NULL, register_date DATE NOT NULL, birth_date DATE NOT NULL, INDEX IDX_2DA17977D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Bid ADD CONSTRAINT FK_72BFF5137C6FCFB9 FOREIGN KEY (user_bidding_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Bid ADD CONSTRAINT FK_72BFF5136BB74515 FOREIGN KEY (house_id) REFERENCES House (id)');
        $this->addSql('ALTER TABLE House ADD CONSTRAINT FK_A6141699158B0682 FOREIGN KEY (coordinates_id) REFERENCES coordinates (id)');
        $this->addSql('ALTER TABLE House ADD CONSTRAINT FK_A61416991DAEDAA6 FOREIGN KEY (house_owner_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784186BB74515 FOREIGN KEY (house_id) REFERENCES House (id)');
        $this->addSql('ALTER TABLE User ADD CONSTRAINT FK_2DA17977D60322AC FOREIGN KEY (role_id) REFERENCES Role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE House DROP FOREIGN KEY FK_A6141699158B0682');
        $this->addSql('ALTER TABLE Bid DROP FOREIGN KEY FK_72BFF5136BB74515');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784186BB74515');
        $this->addSql('ALTER TABLE User DROP FOREIGN KEY FK_2DA17977D60322AC');
        $this->addSql('ALTER TABLE Bid DROP FOREIGN KEY FK_72BFF5137C6FCFB9');
        $this->addSql('ALTER TABLE House DROP FOREIGN KEY FK_A61416991DAEDAA6');
        $this->addSql('DROP TABLE Bid');
        $this->addSql('DROP TABLE coordinates');
        $this->addSql('DROP TABLE House');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE Role');
        $this->addSql('DROP TABLE User');
    }
}
