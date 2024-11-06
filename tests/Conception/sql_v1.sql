CREATE TABLE utilisateur(
   Id_client INT AUTO_INCREMENT,
   utilisateur_prenom VARCHAR(255) ,
   utilisateur_nom VARCHAR(255) ,
   utilisateur_siret VARCHAR(255) ,
   utilisateur_mail VARCHAR(255) ,
   utilisateur_reference VARCHAR(255) ,
   utilisateur_mdp VARCHAR(255) ,
   utilisateur_telephone VARCHAR(255) ,
   utilisateur_verifie BOOLEAN,
   utilisateur_coef VARCHAR(255) ,
   utilisateur_derniere_co DATETIME NOT NULL,
   PRIMARY KEY(Id_client)
);

CREATE TABLE rubrique(
   Id_rubrique INT AUTO_INCREMENT,
   rubrique_libelle VARCHAR(255) ,
   rubrique_image VARCHAR(255) ,
   rubrique_description VARCHAR(255) ,
   Id_rubrique_id_parent INT NOT NULL,
   PRIMARY KEY(Id_rubrique),
   FOREIGN KEY(Id_rubrique_id_parent) REFERENCES rubrique(Id_rubrique)
);

CREATE TABLE fournisseur(
   Id_fournisseur INT AUTO_INCREMENT,
   fournisseur_siret VARCHAR(255) ,
   fournisseur_nom VARCHAR(255) ,
   fournisseur_telephone VARCHAR(255) ,
   fournisseur_mail VARCHAR(255) ,
   fournisseur_constructeur BOOLEAN,
   PRIMARY KEY(Id_fournisseur)
);

CREATE TABLE adresse(
   Id_adresse INT AUTO_INCREMENT,
   adresse_libelle VARCHAR(255) ,
   adresse_ville VARCHAR(255) ,
   adresse_postal TINYINT,
   adresse_type VARCHAR(255) ,
   adresse_telephone VARCHAR(255) ,
   PRIMARY KEY(Id_adresse)
);

CREATE TABLE role(
   Id_role INT AUTO_INCREMENT,
   role_type VARCHAR(255) ,
   role_niveau VARCHAR(255) ,
   PRIMARY KEY(Id_role)
);

CREATE TABLE tva(
   Id_tva INT AUTO_INCREMENT,
   tva_taux DECIMAL(15,2)  ,
   PRIMARY KEY(Id_tva)
);

CREATE TABLE commande(
   Id_commande INT AUTO_INCREMENT,
   commande_paiement VARCHAR(255) ,
   commande_date DATETIME,
   commande_date_paiement DATETIME,
   commande_differe BOOLEAN,
   commande_statut VARCHAR(255) ,
   commande_reference VARCHAR(255) ,
   commande_facture_date DATETIME,
   commande_total_ht DECIMAL(15,2)  ,
   Id_client INT NOT NULL,
   PRIMARY KEY(Id_commande),
   FOREIGN KEY(Id_client) REFERENCES utilisateur(Id_client)
);

CREATE TABLE produit(
   Id_produit INT AUTO_INCREMENT,
   produit_libelle VARCHAR(255) ,
   produit_description TEXT,
   produit_price_ht DECIMAL(15,2)  ,
   produit_reference VARCHAR(255) ,
   produit_image VARCHAR(255) ,
   produit_actif BOOLEAN,
   produit_stock VARCHAR(255) ,
   Id_tva INT NOT NULL,
   Id_rubrique INT NOT NULL,
   Id_fournisseur INT NOT NULL,
   PRIMARY KEY(Id_produit),
   FOREIGN KEY(Id_tva) REFERENCES tva(Id_tva),
   FOREIGN KEY(Id_rubrique) REFERENCES rubrique(Id_rubrique),
   FOREIGN KEY(Id_fournisseur) REFERENCES fournisseur(Id_fournisseur)
);

CREATE TABLE facture(
   Id_facture INT AUTO_INCREMENT,
   facture_libelle VARCHAR(255) ,
   Id_commande INT NOT NULL,
   PRIMARY KEY(Id_facture),
   FOREIGN KEY(Id_commande) REFERENCES commande(Id_commande)
);

CREATE TABLE livraison(
   Id_livraison INT AUTO_INCREMENT,
   livraison_statut VARCHAR(255) ,
   livraison_date DATETIME,
   livraison_reference VARCHAR(255) ,
   Id_commande INT NOT NULL,
   PRIMARY KEY(Id_livraison),
   FOREIGN KEY(Id_commande) REFERENCES commande(Id_commande)
);

CREATE TABLE possede(
   Id_client INT,
   Id_adresse INT,
   PRIMARY KEY(Id_client, Id_adresse),
   FOREIGN KEY(Id_client) REFERENCES utilisateur(Id_client),
   FOREIGN KEY(Id_adresse) REFERENCES adresse(Id_adresse)
);

CREATE TABLE appartient_(
   Id_commande INT,
   Id_produit INT,
   quantite DECIMAL(15,2)  ,
   prix_de_vente DECIMAL(19,4),
   PRIMARY KEY(Id_commande, Id_produit),
   FOREIGN KEY(Id_commande) REFERENCES commande(Id_commande),
   FOREIGN KEY(Id_produit) REFERENCES produit(Id_produit)
);

CREATE TABLE beneficie(
   Id_fournisseur INT,
   Id_adresse INT,
   PRIMARY KEY(Id_fournisseur, Id_adresse),
   FOREIGN KEY(Id_fournisseur) REFERENCES fournisseur(Id_fournisseur),
   FOREIGN KEY(Id_adresse) REFERENCES adresse(Id_adresse)
);

CREATE TABLE communique(
   Id_client INT,
   Id_fournisseur INT,
   PRIMARY KEY(Id_client, Id_fournisseur),
   FOREIGN KEY(Id_client) REFERENCES utilisateur(Id_client),
   FOREIGN KEY(Id_fournisseur) REFERENCES fournisseur(Id_fournisseur)
);

CREATE TABLE definie(
   Id_client INT,
   Id_role INT,
   PRIMARY KEY(Id_client, Id_role),
   FOREIGN KEY(Id_client) REFERENCES utilisateur(Id_client),
   FOREIGN KEY(Id_role) REFERENCES role(Id_role)
);

CREATE TABLE observe(
   Id_produit INT,
   Id_client INT,
   PRIMARY KEY(Id_produit, Id_client),
   FOREIGN KEY(Id_produit) REFERENCES produit(Id_produit),
   FOREIGN KEY(Id_client) REFERENCES utilisateur(Id_client)
);

CREATE TABLE genere(
   Id_produit INT,
   Id_livraison INT,
   quantite INT,
   PRIMARY KEY(Id_produit, Id_livraison),
   FOREIGN KEY(Id_produit) REFERENCES produit(Id_produit),
   FOREIGN KEY(Id_livraison) REFERENCES livraison(Id_livraison)
);
