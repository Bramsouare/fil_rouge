<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120100313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, adresse_libelle VARCHAR(255) NOT NULL, adresse_ville VARCHAR(255) NOT NULL, adresse_postal SMALLINT NOT NULL, adresse_type VARCHAR(255) NOT NULL, adresse_telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, livraison_id INT NOT NULL, facture_id INT NOT NULL, commande_paiement VARCHAR(255) NOT NULL, commande_date DATETIME NOT NULL, commande_date_paiement DATETIME NOT NULL, commande_differe TINYINT(1) NOT NULL, commande_statut VARCHAR(255) NOT NULL, commande_reference VARCHAR(255) NOT NULL, commande_facture_date DATETIME NOT NULL, commande_total_ht NUMERIC(10, 10) NOT NULL, INDEX IDX_6EEAA67D8E54FB25 (livraison_id), INDEX IDX_6EEAA67D7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, id_produit_id INT NOT NULL, id_commande_id INT NOT NULL, quantite NUMERIC(15, 2) NOT NULL, prix_de_vente NUMERIC(19, 4) NOT NULL, INDEX IDX_98344FA682EA2E54 (commande_id), INDEX IDX_98344FA6AABEFE2C (id_produit_id), INDEX IDX_98344FA69AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_livraison (id INT AUTO_INCREMENT NOT NULL, id_livraison_id INT NOT NULL, id_produit_id INT NOT NULL, quantite NUMERIC(15, 2) NOT NULL, INDEX IDX_B7FB4AAAAD958E57 (id_livraison_id), INDEX IDX_B7FB4AAAAABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, facture_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, fournisseur_siret VARCHAR(255) NOT NULL, fournisseur_nom VARCHAR(255) NOT NULL, fournisseur_telephone VARCHAR(255) NOT NULL, fournisseur_mail VARCHAR(255) NOT NULL, fournisseur_constructeur TINYINT(1) NOT NULL, INDEX IDX_369ECA32F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur_adresse (fournisseur_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_119F47BB670C757F (fournisseur_id), INDEX IDX_119F47BB4DE7DC5C (adresse_id), PRIMARY KEY(fournisseur_id, adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, livraison_statut VARCHAR(255) NOT NULL, livraison_date DATETIME NOT NULL, livraison_reference VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, tva_id INT NOT NULL, produit_libelle VARCHAR(255) NOT NULL, produit_description LONGTEXT NOT NULL, produit_prix_ht NUMERIC(15, 2) NOT NULL, produit_reference VARCHAR(255) NOT NULL, produit_image VARCHAR(255) NOT NULL, produit_actif TINYINT(1) NOT NULL, produit_stock VARCHAR(255) NOT NULL, INDEX IDX_29A5EC274D79775F (tva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_type VARCHAR(255) NOT NULL, role_niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrique (id INT AUTO_INCREMENT NOT NULL, rubrique_id INT DEFAULT NULL, produit_id INT NOT NULL, rubrique_libelle VARCHAR(255) NOT NULL, rubrique_image VARCHAR(255) NOT NULL, rubrique_description VARCHAR(255) NOT NULL, INDEX IDX_8FA4097C3BD38833 (rubrique_id), INDEX IDX_8FA4097CF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tva (id INT AUTO_INCREMENT NOT NULL, tva_taux NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, utilisateur_prenom VARCHAR(255) NOT NULL, utilisateur_nom VARCHAR(255) NOT NULL, utilisateur_siret VARCHAR(255) DEFAULT NULL, utilisateur_mail VARCHAR(255) NOT NULL, utilisateur_reference VARCHAR(255) NOT NULL, utilisateur_mdp VARCHAR(255) NOT NULL, utilisateur_telephone VARCHAR(255) NOT NULL, utilisateur_verifie TINYINT(1) NOT NULL, utilisateur_coef VARCHAR(255) NOT NULL, utilisateur_derniere_co DATETIME NOT NULL, INDEX IDX_1D1C63B382EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_fournisseur (utilisateur_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_C278C7A1FB88E14F (utilisateur_id), INDEX IDX_C278C7A1670C757F (fournisseur_id), PRIMARY KEY(utilisateur_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_adresse (utilisateur_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_B954FF84FB88E14F (utilisateur_id), INDEX IDX_B954FF844DE7DC5C (adresse_id), PRIMARY KEY(utilisateur_id, adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_role (utilisateur_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_9EE8E650FB88E14F (utilisateur_id), INDEX IDX_9EE8E650D60322AC (role_id), PRIMARY KEY(utilisateur_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_produit (utilisateur_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_53AE1BB5FB88E14F (utilisateur_id), INDEX IDX_53AE1BB5F347EFB (produit_id), PRIMARY KEY(utilisateur_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA69AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail_livraison ADD CONSTRAINT FK_B7FB4AAAAD958E57 FOREIGN KEY (id_livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE detail_livraison ADD CONSTRAINT FK_B7FB4AAAAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA32F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE fournisseur_adresse ADD CONSTRAINT FK_119F47BB670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_adresse ADD CONSTRAINT FK_119F47BB4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097C3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE utilisateur_fournisseur ADD CONSTRAINT FK_C278C7A1FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_fournisseur ADD CONSTRAINT FK_C278C7A1670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_adresse ADD CONSTRAINT FK_B954FF84FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_adresse ADD CONSTRAINT FK_B954FF844DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_role ADD CONSTRAINT FK_9EE8E650FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_role ADD CONSTRAINT FK_9EE8E650D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_produit ADD CONSTRAINT FK_53AE1BB5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_produit ADD CONSTRAINT FK_53AE1BB5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7F2DEE08');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA682EA2E54');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6AABEFE2C');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA69AF8E3A3');
        $this->addSql('ALTER TABLE detail_livraison DROP FOREIGN KEY FK_B7FB4AAAAD958E57');
        $this->addSql('ALTER TABLE detail_livraison DROP FOREIGN KEY FK_B7FB4AAAAABEFE2C');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA32F347EFB');
        $this->addSql('ALTER TABLE fournisseur_adresse DROP FOREIGN KEY FK_119F47BB670C757F');
        $this->addSql('ALTER TABLE fournisseur_adresse DROP FOREIGN KEY FK_119F47BB4DE7DC5C');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274D79775F');
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097C3BD38833');
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097CF347EFB');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B382EA2E54');
        $this->addSql('ALTER TABLE utilisateur_fournisseur DROP FOREIGN KEY FK_C278C7A1FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_fournisseur DROP FOREIGN KEY FK_C278C7A1670C757F');
        $this->addSql('ALTER TABLE utilisateur_adresse DROP FOREIGN KEY FK_B954FF84FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_adresse DROP FOREIGN KEY FK_B954FF844DE7DC5C');
        $this->addSql('ALTER TABLE utilisateur_role DROP FOREIGN KEY FK_9EE8E650FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_role DROP FOREIGN KEY FK_9EE8E650D60322AC');
        $this->addSql('ALTER TABLE utilisateur_produit DROP FOREIGN KEY FK_53AE1BB5FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_produit DROP FOREIGN KEY FK_53AE1BB5F347EFB');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE detail_livraison');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournisseur_adresse');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE tva');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_fournisseur');
        $this->addSql('DROP TABLE utilisateur_adresse');
        $this->addSql('DROP TABLE utilisateur_role');
        $this->addSql('DROP TABLE utilisateur_produit');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
