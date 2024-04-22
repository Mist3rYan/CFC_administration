<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240422095121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD fr_1 VARCHAR(255) NOT NULL, ADD fr_2 VARCHAR(255) NOT NULL, ADD fr_3 VARCHAR(255) NOT NULL, ADD fr_correct VARCHAR(255) NOT NULL, ADD en_1 VARCHAR(255) NOT NULL, ADD en_2 VARCHAR(255) NOT NULL, ADD en_3 VARCHAR(255) NOT NULL, ADD en_correct VARCHAR(255) NOT NULL, ADD es_1 VARCHAR(255) NOT NULL, ADD es_2 VARCHAR(255) NOT NULL, ADD es_3 VARCHAR(255) NOT NULL, ADD es_correct VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP fr_1, DROP fr_2, DROP fr_3, DROP fr_correct, DROP en_1, DROP en_2, DROP en_3, DROP en_correct, DROP es_1, DROP es_2, DROP es_3, DROP es_correct');
    }
}
