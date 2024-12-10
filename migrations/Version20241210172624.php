<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210172624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86417A580B');
        $this->addSql('DROP INDEX IDX_10C31F86417A580B ON rdv');
        $this->addSql('ALTER TABLE rdv DROP id_domaine_medical_id, CHANGE id_medecin_id id_medecin_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv ADD id_domaine_medical_id INT DEFAULT NULL, CHANGE id_medecin_id id_medecin_id INT NOT NULL');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86417A580B FOREIGN KEY (id_domaine_medical_id) REFERENCES domaine_medical (id)');
        $this->addSql('CREATE INDEX IDX_10C31F86417A580B ON rdv (id_domaine_medical_id)');
    }
}
