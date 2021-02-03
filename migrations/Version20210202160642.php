<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202160642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create an `Activity` table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
            CREATE TABLE activity (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(64) NOT NULL DEFAULT 'Sin título',
                description VARCHAR(100) NOT NULL DEFAULT 'Sin descripción',
                availabilityStartDate DATETIME NOT NULL,
                availabilityEndDate DATETIME NOT NULL,
                pricePerPax FLOAT NOT NULL DEFAULT 0.0,
                popularity INT NOT NULL DEFAULT 0,
                createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT U_title UNIQUE KEY(title)
            )
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE 'activity'");
    }
}
