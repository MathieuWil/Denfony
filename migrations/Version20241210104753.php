<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210104753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domaine_medical (id INT AUTO_INCREMENT NOT NULL, iddomaine INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, id_medecin_id INT NOT NULL, id_domaine_id INT DEFAULT NULL, date_debut DATE DEFAULT NULL, UNIQUE INDEX UNIQ_1BDA53C6A1799A53 (id_medecin_id), INDEX IDX_1BDA53C6E7F87C48 (id_domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, id_rdv_id INT NOT NULL, date_delivree DATE NOT NULL, medicament VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_924B326C6AF98A6B (id_rdv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT NOT NULL, date_inscription DATE NOT NULL, adresse VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1ADAD7EBCE0312AE (id_patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT NOT NULL, id_medecin_id INT NOT NULL, id_domaine_medical_id INT DEFAULT NULL, date_rdv DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, statut VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_10C31F86CE0312AE (id_patient_id), UNIQUE INDEX UNIQ_10C31F86A1799A53 (id_medecin_id), INDEX IDX_10C31F86417A580B (id_domaine_medical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6A1799A53 FOREIGN KEY (id_medecin_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6E7F87C48 FOREIGN KEY (id_domaine_id) REFERENCES domaine_medical (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C6AF98A6B FOREIGN KEY (id_rdv_id) REFERENCES rdv (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBCE0312AE FOREIGN KEY (id_patient_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86CE0312AE FOREIGN KEY (id_patient_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86A1799A53 FOREIGN KEY (id_medecin_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86417A580B FOREIGN KEY (id_domaine_medical_id) REFERENCES domaine_medical (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6A1799A53');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6E7F87C48');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C6AF98A6B');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBCE0312AE');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86CE0312AE');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86A1799A53');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86417A580B');
        $this->addSql('DROP TABLE domaine_medical');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
