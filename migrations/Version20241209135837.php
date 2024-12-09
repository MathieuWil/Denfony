<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209135837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domaine_medical (id INT AUTO_INCREMENT NOT NULL, iddomaine INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, idmedecin_id INT NOT NULL, iddomaine_id INT DEFAULT NULL, date_debut DATE NOT NULL, UNIQUE INDEX UNIQ_1BDA53C6C95A07BE (idmedecin_id), INDEX IDX_1BDA53C68FDBE1A5 (iddomaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, idrdv_id INT DEFAULT NULL, date_delivree DATE NOT NULL, medicament VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_924B326C2873922A (idrdv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, idpatient_id INT NOT NULL, date_inscription DATE NOT NULL, adresse VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1ADAD7EBA6208F43 (idpatient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, idpatient_id INT DEFAULT NULL, idmedecin_id INT DEFAULT NULL, idrdv INT NOT NULL, daterdv DATETIME NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_10C31F86A6208F43 (idpatient_id), INDEX IDX_10C31F86C95A07BE (idmedecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6C95A07BE FOREIGN KEY (idmedecin_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C68FDBE1A5 FOREIGN KEY (iddomaine_id) REFERENCES domaine_medical (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C2873922A FOREIGN KEY (idrdv_id) REFERENCES rdv (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBA6208F43 FOREIGN KEY (idpatient_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86A6208F43 FOREIGN KEY (idpatient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86C95A07BE FOREIGN KEY (idmedecin_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6C95A07BE');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C68FDBE1A5');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C2873922A');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBA6208F43');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86A6208F43');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86C95A07BE');
        $this->addSql('DROP TABLE domaine_medical');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE rdv');
    }
}
