<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311130657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, sexe VARCHAR(15) NOT NULL, date_naissance DATETIME NOT NULL, annee_suivie VARCHAR(10) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(10) NOT NULL, ville_domicile VARCHAR(100) NOT NULL, courriel VARCHAR(50) NOT NULL, telephone_o VARCHAR(20) NOT NULL, telephone_s VARCHAR(20) DEFAULT NULL, niveau VARCHAR(20) NOT NULL, classe VARCHAR(20) NOT NULL, duree_intervention VARCHAR(30) NOT NULL, lieu_intervention VARCHAR(50) NOT NULL, contact VARCHAR(100) NOT NULL, contact_num VARCHAR(20) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, certificat_medical TINYINT(1) NOT NULL, ri TINYINT(1) NOT NULL, enveloppes TINYINT(1) NOT NULL, cheques TINYINT(1) NOT NULL, INDEX IDX_ECA105F7FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_professeur (eleve_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_159FBDCBA6CC7B2 (eleve_id), INDEX IDX_159FBDCBBAB22EE9 (professeur_id), PRIMARY KEY(eleve_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, type VARCHAR(30) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(10) NOT NULL, ville VARCHAR(100) NOT NULL, courriel VARCHAR(100) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mairie (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(100) NOT NULL, code_postal VARCHAR(10) NOT NULL, zone VARCHAR(50) NOT NULL, lien_dossier VARCHAR(100) NOT NULL, courriel VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(10) NOT NULL, ville_domicile VARCHAR(100) NOT NULL, courriel VARCHAR(50) NOT NULL, telephone_o VARCHAR(20) NOT NULL, telephone_s VARCHAR(20) DEFAULT NULL, situation_actuelle VARCHAR(15) NOT NULL, matieres LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', niveau VARCHAR(30) NOT NULL, zones_interventions LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', lieux_interventions LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', toutes_maladies TINYINT(1) NOT NULL, voiture TINYINT(1) NOT NULL, cv TINYINT(1) NOT NULL, cj TINYINT(1) NOT NULL, commentaires LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_bis (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, age INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE eleve_professeur ADD CONSTRAINT FK_159FBDCBA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_professeur ADD CONSTRAINT FK_159FBDCBBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eleve_professeur DROP FOREIGN KEY FK_159FBDCBA6CC7B2');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7FF631228');
        $this->addSql('ALTER TABLE eleve_professeur DROP FOREIGN KEY FK_159FBDCBBAB22EE9');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE eleve_professeur');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE mairie');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE test_bis');
    }
}
