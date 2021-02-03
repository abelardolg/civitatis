<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202233812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create an `Booking` table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
            CREATE TABLE booking (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                activityID INT NOT NULL,
                numPax INT NOT NULL DEFAULT 0,
                price FLOAT NOT NULL DEFAULT 0.0,
                bookDate DATETIME NOT NULL,
                doneDate DATETIME NOT NULL,
                createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX IDX_bookDate (bookDate),
                INDEX IDX_doneDate (doneDate),
                FOREIGN KEY (activity_id)
                    REFERENCES  activity(id)
                    ON UPDATE CASCADE ON DELETE RESTRICT
            )
        ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE 'booking'");

    }
}
