<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210233802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP INDEX UNIQ_10C31F86CE0312AE, ADD INDEX IDX_10C31F86CE0312AE (id_patient_id)');
        $this->addSql('ALTER TABLE rdv DROP INDEX UNIQ_10C31F86A1799A53, ADD INDEX IDX_10C31F86A1799A53 (id_medecin_id)');
        $this->addSql('ALTER TABLE rdv CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP INDEX IDX_10C31F86CE0312AE, ADD UNIQUE INDEX UNIQ_10C31F86CE0312AE (id_patient_id)');
        $this->addSql('ALTER TABLE rdv DROP INDEX IDX_10C31F86A1799A53, ADD UNIQUE INDEX UNIQ_10C31F86A1799A53 (id_medecin_id)');
        $this->addSql('ALTER TABLE rdv CHANGE description description LONGTEXT DEFAULT NULL');
    }
}
