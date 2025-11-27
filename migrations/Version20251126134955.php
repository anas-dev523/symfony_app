<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251126134955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, id_utilisateur VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_ID_UTILISATEUR (id_utilisateur), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE commentaire_contenu DROP FOREIGN KEY `commentaire_contenu_ibfk_1`');
        $this->addSql('ALTER TABLE commentaire_contenu DROP FOREIGN KEY `commentaire_contenu_ibfk_2`');
        $this->addSql('ALTER TABLE consultation_citation DROP FOREIGN KEY `consultation_citation_ibfk_1`');
        $this->addSql('ALTER TABLE consultation_citation DROP FOREIGN KEY `consultation_citation_ibfk_2`');
        $this->addSql('ALTER TABLE demande_aide DROP FOREIGN KEY `demande_aide_ibfk_1`');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY `don_ibfk_1`');
        $this->addSql('ALTER TABLE passer_defi DROP FOREIGN KEY `passer_defi_ibfk_1`');
        $this->addSql('ALTER TABLE passer_defi DROP FOREIGN KEY `passer_defi_ibfk_2`');
        $this->addSql('ALTER TABLE retour_experience DROP FOREIGN KEY `retour_experience_ibfk_1`');
        $this->addSql('ALTER TABLE retour_experience DROP FOREIGN KEY `retour_experience_ibfk_2`');
        $this->addSql('DROP TABLE citation');
        $this->addSql('DROP TABLE commentaire_contenu');
        $this->addSql('DROP TABLE consultation_citation');
        $this->addSql('DROP TABLE defi');
        $this->addSql('DROP TABLE demande_aide');
        $this->addSql('DROP TABLE don');
        $this->addSql('DROP TABLE passer_defi');
        $this->addSql('DROP TABLE retour_experience');
        $this->addSql('DROP TABLE utilisateurs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE citation (id_citation INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, auteur VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, date_ajout VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, PRIMARY KEY (id_citation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaire_contenu (id_commentaire INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_commentaire VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, id_utilisateur INT NOT NULL, id_retour INT NOT NULL, INDEX id_retour (id_retour), INDEX id_utilisateur (id_utilisateur), PRIMARY KEY (id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE consultation_citation (id_citation INT NOT NULL, id_utilisateur INT NOT NULL, date_consultation VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX id_utilisateur (id_utilisateur), INDEX IDX_B4FC1CDBAA6670EB (id_citation), PRIMARY KEY (id_citation, id_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE defi (id_defi INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, difficulte VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, duree INT NOT NULL, date_publication VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, statut_moderation VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, PRIMARY KEY (id_defi)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE demande_aide (id_aide INT AUTO_INCREMENT NOT NULL, concernant VARCHAR(225) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_demande VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id_utilisateur INT NOT NULL, INDEX id_utilisateur (id_utilisateur), PRIMARY KEY (id_aide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE don (id_don INT AUTO_INCREMENT NOT NULL, montant INT NOT NULL, est_public TINYINT(1) DEFAULT 0 NOT NULL, date_don VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id_utilisateur INT NOT NULL, INDEX id_utilisateur (id_utilisateur), PRIMARY KEY (id_don)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE passer_defi (id_utilisateur INT NOT NULL, id_defi INT NOT NULL, duree INT DEFAULT NULL, date_passage VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX id_defi (id_defi), INDEX IDX_98C70EE250EAE44 (id_utilisateur), PRIMARY KEY (id_utilisateur, id_defi)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE retour_experience (id_retour INT AUTO_INCREMENT NOT NULL, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, note INT NOT NULL, emoji VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_retour VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id_utilisateur INT NOT NULL, id_defi INT NOT NULL, INDEX id_defi (id_defi), INDEX id_utilisateur (id_utilisateur), PRIMARY KEY (id_retour)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateurs (id_utilisateur INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, affichage_public TINYINT(1) DEFAULT 0, UNIQUE INDEX email (email), PRIMARY KEY (id_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaire_contenu ADD CONSTRAINT `commentaire_contenu_ibfk_1` FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_contenu ADD CONSTRAINT `commentaire_contenu_ibfk_2` FOREIGN KEY (id_retour) REFERENCES retour_experience (id_retour) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_citation ADD CONSTRAINT `consultation_citation_ibfk_1` FOREIGN KEY (id_citation) REFERENCES citation (id_citation) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_citation ADD CONSTRAINT `consultation_citation_ibfk_2` FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande_aide ADD CONSTRAINT `demande_aide_ibfk_1` FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT `don_ibfk_1` FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE passer_defi ADD CONSTRAINT `passer_defi_ibfk_1` FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE passer_defi ADD CONSTRAINT `passer_defi_ibfk_2` FOREIGN KEY (id_defi) REFERENCES defi (id_defi) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE retour_experience ADD CONSTRAINT `retour_experience_ibfk_1` FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE retour_experience ADD CONSTRAINT `retour_experience_ibfk_2` FOREIGN KEY (id_defi) REFERENCES defi (id_defi) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE `user`');
    }
}
