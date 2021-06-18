<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618195328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, engine_id INT NOT NULL, make VARCHAR(255) NOT NULL, body_type VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, year DATETIME NOT NULL, mileage VARCHAR(255) NOT NULL, fuel_type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, price INT NOT NULL, country VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, INDEX IDX_773DE69DE78C9C0A (engine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE engine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, capacity INT NOT NULL, horsepower INT NOT NULL, torque INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DE78C9C0A FOREIGN KEY (engine_id) REFERENCES engine (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DE78C9C0A');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE engine');
    }
}
