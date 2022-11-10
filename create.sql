use website;

CREATE TABLE produit(
   id_produit INT,
   titre VARCHAR(50) NOT NULL,
   prix DECIMAL(6,2) NOT NULL,
   description VARCHAR(500) NOT NULL,
   disponible INT NOT NULL,
   PRIMARY KEY(id_produit)
);

CREATE TABLE utilisateur(
   id_utilisateur INT,
   prenom VARCHAR(50) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   password TEXT NOT NULL,
   email VARCHAR(50) NOT NULL,
   status VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_utilisateur)
);

CREATE TABLE categorie(
   id_categorie INT,
   libelle VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_categorie),
   UNIQUE(libelle)
);

CREATE TABLE facture(
   id_facture INT,
   date_facture DATETIME NOT NULL,
   total DECIMAL(15,2) NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_facture),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE affectation (
   id_produit INT,
   id_categorie INT,
   PRIMARY KEY(id_produit, id_categorie),
   FOREIGN KEY(id_produit) REFERENCES produit(id_produit),
   FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie)
);

CREATE TABLE favori(
   id_produit INT,
   id_utilisateur INT,
   PRIMARY KEY(id_produit, id_utilisateur),
   FOREIGN KEY(id_produit) REFERENCES produit(id_produit),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE achat(
   id_produit INT,
   id_facture INT,
   prix DECIMAL(6,2),
   PRIMARY KEY(id_produit, id_facture),
   FOREIGN KEY(id_produit) REFERENCES produit(id_produit),
   FOREIGN KEY(id_facture) REFERENCES facture(id_facture)
);