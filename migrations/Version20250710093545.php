<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250710093545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repas (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, ajoute_par_id INT NOT NULL, date_heure DATETIME NOT NULL, nourriture_donnee VARCHAR(255) NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_A8D351B38E962C16 (animal_id), INDEX IDX_A8D351B3DAA76F43 (ajoute_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B38E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B3DAA76F43 FOREIGN KEY (ajoute_par_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B38E962C16');
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B3DAA76F43');
        $this->addSql('DROP TABLE repas');
    }
}
