<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250711112038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte_rendu_veterinaire (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, veterinaire_id INT NOT NULL, etat VARCHAR(255) NOT NULL, nourriture VARCHAR(255) DEFAULT NULL, grammage DOUBLE PRECISION DEFAULT NULL, date DATETIME NOT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_DE92162E8E962C16 (animal_id), INDEX IDX_DE92162E5C80924 (veterinaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte_rendu_veterinaire ADD CONSTRAINT FK_DE92162E8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE compte_rendu_veterinaire ADD CONSTRAINT FK_DE92162E5C80924 FOREIGN KEY (veterinaire_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_rendu_veterinaire DROP FOREIGN KEY FK_DE92162E8E962C16');
        $this->addSql('ALTER TABLE compte_rendu_veterinaire DROP FOREIGN KEY FK_DE92162E5C80924');
        $this->addSql('DROP TABLE compte_rendu_veterinaire');
        $this->addSql('DROP TABLE service');
    }
}
