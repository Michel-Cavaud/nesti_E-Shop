<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422154544 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles CHANGE id_externe id_externe INT AUTO_INCREMENT NOT NULL, CHANGE id_produits id_produits INT DEFAULT NULL, CHANGE id_unites_de_mesure id_unites_de_mesure INT DEFAULT NULL, CHANGE id_images id_images INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_de_commandes DROP quantite_commandes');
        $this->addSql('ALTER TABLE ligne_de_commandes RENAME INDEX id_commandes TO IDX_521E0AEAB5E1940B');
        $this->addSql('ALTER TABLE commandes CHANGE id_utilisateurs id_utilisateurs INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaires CHANGE id_moderateurs id_moderateurs INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredients_recettes CHANGE id_unites_de_mesure id_unites_de_mesure INT DEFAULT NULL');
        $this->addSql('ALTER TABLE logs_utilisateurs CHANGE id_utilisateurs id_utilisateurs INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lots DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE lots ADD PRIMARY KEY (ref_commandes_lots, id_externe)');
        $this->addSql('ALTER TABLE importations DROP date_importation');
        $this->addSql('ALTER TABLE importations RENAME INDEX id_admin TO IDX_2E822A3A668B4C46');
        $this->addSql('ALTER TABLE paragraphes CHANGE id_recettes id_recettes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix_article CHANGE id_externe id_externe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recettes CHANGE id_chef id_chef INT DEFAULT NULL, CHANGE id_images id_images INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donne_une_note DROP note_sur_5');
        $this->addSql('ALTER TABLE donne_une_note RENAME INDEX id_utilisateurs TO IDX_7177E926ABA442C');
        $this->addSql('ALTER TABLE list_categories RENAME INDEX id_categories TO IDX_E0DE32B49F79C6BF');
        $this->addSql('ALTER TABLE utilisateurs CHANGE id_ville id_ville INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles CHANGE id_externe id_externe INT NOT NULL, CHANGE id_produits id_produits INT NOT NULL, CHANGE id_unites_de_mesure id_unites_de_mesure INT NOT NULL, CHANGE id_images id_images INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commandes CHANGE id_utilisateurs id_utilisateurs INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires CHANGE id_moderateurs id_moderateurs INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donne_une_note ADD note_sur_5 TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE donne_une_note RENAME INDEX idx_7177e926aba442c TO id_utilisateurs');
        $this->addSql('ALTER TABLE importations ADD date_importation DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE importations RENAME INDEX idx_2e822a3a668b4c46 TO id_admin');
        $this->addSql('ALTER TABLE ingredients_recettes CHANGE id_unites_de_mesure id_unites_de_mesure INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_de_commandes ADD quantite_commandes TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE ligne_de_commandes RENAME INDEX idx_521e0aeab5e1940b TO id_commandes');
        $this->addSql('ALTER TABLE list_categories RENAME INDEX idx_e0de32b49f79c6bf TO id_categories');
        $this->addSql('ALTER TABLE logs_utilisateurs CHANGE id_utilisateurs id_utilisateurs INT NOT NULL');
        $this->addSql('ALTER TABLE lots DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE lots ADD PRIMARY KEY (id_externe, ref_commandes_lots)');
        $this->addSql('ALTER TABLE paragraphes CHANGE id_recettes id_recettes INT NOT NULL');
        $this->addSql('ALTER TABLE prix_article CHANGE id_externe id_externe INT NOT NULL');
        $this->addSql('ALTER TABLE recettes CHANGE id_chef id_chef INT NOT NULL, CHANGE id_images id_images INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs CHANGE id_ville id_ville INT DEFAULT NULL');
    }
}
