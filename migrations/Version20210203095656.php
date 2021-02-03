<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203095656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create an `ActivityRelated` table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
            CREATE TABLE activityRelated (
                idMainActivity INT NOT NULL ,
                idRelatedActivity INT NOT NULL
            )
        ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE 'activityRelated'");
    }
}
