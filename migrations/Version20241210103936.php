<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210103936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la colonne image_url dans la table habitat';
    }

    public function up(Schema $schema): void
    {
        // Ajouter la colonne image_url à la table habitat
        $this->addSql('ALTER TABLE habitat ADD image_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // Supprimer la colonne image_url lors d'un rollback
        $this->addSql('ALTER TABLE habitat DROP COLUMN image_url');
    }
}
