# Rapport SQL - Groupe 3 équipe 0
Participants
- Martin Schreiber
- Baptiste Bégarie
- Louis Painter
- Mathis Michenaud
- Alexandre Carol

> groupe 3 equipe 0

## Schéma Relationnel
![image](https://cdn.discordapp.com/attachments/1029002019148677210/1061938652999073894/image.png)\
Dans notre base de données, nous avons plusieurs entités comme utilisateur, facture, produit et catégorie. Nous relions facture et utilisateur avec l'association `possède facture`, qui ne créée pas de table dû à la cardinalité `1,1` du coté de facture, elle se manifeste donc par un ajout de `id_utilisateur` dans la table facture. En effet, un utilisateur peut avoir de 0 à plusieurs factures, et une facture ne peut avoir qu'un seul utilisateur. \
Ensuite, une facture peut avoir un ou plusieurs produits et un produit peut être dans 0 ou plusieurs factures, d'où l'association `achat` entre `produit` et `facture`. Ainsi, cette association se traduit en une table `achat` qui contient un `id_produit`, un `id_facture` et le `prix` permettant de connaître la somme payée même si le prix du produit change dans le futur. \
Enfin, `produit` et `catégorie` sont reliés par `affectation` : un produit peut avoir aucune ou plusieurs catégories, et une catégorie peut avoir aucun ou plusieurs produits.

Il convient de noter que les images des produits ne sont pas stockées dans la base de données puisque cela est déconseillé. Elles sont donc placées sur le stockage de la machine virtuelle directement. 

## Procédures
Plusieurs procédures ont été créées pour nous aider dans notre tâche. Il y a plusieurs procédures par table, par exemple pour `categorie`, on retrouve :
```sql
DELIMITER &&
create or replace procedure addCategorie(IN leLibelle VARCHAR(50)) 
BEGIN 
INSERT INTO categorie (libelle) values (leLibelle); 
END&&

create or replace PROCEDURE updateCategorie(IN categorieId INT, IN leLibelle VARCHAR(50))
BEGIN
UPDATE categorie SET libelle=leLibelle WHERE id_categorie=categorieId;
END&&

create or replace PROCEDURE removeCategorie(IN categorieId INT)
BEGIN
DELETE FROM affectation where id_categorie = categorieId;
DELETE FROM categorie where id_categorie = categorieId;
END&&
DELIMITER ;
```
Ici nous avons 3 procédures, `addCategorie`, `updateCategorie`, et `removeCategorie`. Ces procédures sont très peu complexes étant donné qu'elles n'utilisent respectivement qu'un `INSERT`, un `UPDATE` ou un `DELETE`, le seul élément notable est la suppression des lignes d'`affectation` lors de l'appel de `removeCategorie`. Ces procédures sont aussi disponibles pour les tables `achat`, `affectation`, `facture`, `produit`, et `utilisateur`.\
On ne va pas passer sur toutes ces procédures car ce serait un peu de la répétition, donc passons directement aux procédures intéréssantes. On a :
```sql
DELIMITER &&
create or replace procedure getBoughtProductsOfUser (IN userId INT)
BEGIN
select p.* from achat a, facture f, produit p where a.id_facture = f.id_facture and a.id_produit = p.id_produit and f.id_utilisateur = userId;
END &&
DELIMITER ;
```
cette procédure retourne tous les produits achetés par un utilisateur, ce qui est utile quand on veut afficher toutes ses commandes a cet utilisateur, mais aussi pour vérifier ce qu'il a acheté. Cependant, dans ce cas-ci, on peut aussi utiliser la procédure suivante:
```sql
DELIMITER &&
create or replace procedure boughtFromUser (IN idproduit INT, IN userMail VARCHAR(200), OUT res INT)
BEGIN 
select count(achat.id_produit) into res
from achat 
inner join facture on facture.id_facture = achat.id_facture  
inner join utilisateur on utilisateur.id_utilisateur = facture.id_utilisateur 
where id_produit = idproduit and email = userMail; 
END&&
DELIMITER ;
```
Cette procédure vérifie qu'un produit avec l'id `idproduit` a été acheté par l'utilisateur avec l'email `userMail` et retourne dans la variable `res` le résultat (1 si acheté, 0 sinon)\
Il nous reste les procédures `toggleVisibility` pour `produit` : 
```sql
DELIMITER &&
create or replace procedure toggleVisibility(IN idProduit INT)
BEGIN
UPDATE produit SET disponible = 1 - (select disponible from produit where id_produit = idProduit) where id_produit = idProduit;
END&&
DELIMITER ;
```
Qui va faire en sorte qu'un produit indisponible soit a nouveau disponible, ou qu'un produit disponible soit indisponible, peu importe l'état au départ.\
Il y a enfin `activeUser`:
```sql
DELIMITER &&
create or replace procedure activeUser(IN idUser INT, IN leEtat VARCHAR(20))
BEGIN
update utilisateur set etat=leEtat where id_utilisateur = idUser;
END&&
DELIMITER ;
```
qui va activer ou désactiver un utilisateur, cette fois-ci en fonction de l'état donné a la fonction.

## Code
Le code complet de chaque procédure et table est disponible ici : 
### Tables
```sql
use website;

create or replace TABLE produit(
   id_produit INT NOT NULL AUTO_INCREMENT,
   titre VARCHAR(50) NOT NULL,
   prix DECIMAL(6,2) NOT NULL,
   description VARCHAR(500) NOT NULL,
   disponible INT NOT NULL,
   PRIMARY KEY(id_produit)
);

create or replace TABLE utilisateur(
   id_utilisateur INT NOT NULL AUTO_INCREMENT,
   prenom VARCHAR(50) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   password TEXT NOT NULL,
   email VARCHAR(50) NOT NULL,
   status VARCHAR(50) NOT NULL,
   numrue VARCHAR(50) NOT NULL,
   adresse VARCHAR(300) NOT NULL,
   ville VARCHAR(50) NOT NULL,
   postalcode VARCHAR(5) NOT NULL,
   pays VARCHAR(50) NOT NULL,
   etat VARCHAR(20) NOT NULL default 'active',
   PRIMARY KEY(id_utilisateur),
   UNIQUE(email)
);

create or replace TABLE categorie(
   id_categorie INT NOT NULL AUTO_INCREMENT,
   libelle VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_categorie),
   UNIQUE(libelle)
);

create or replace TABLE facture(
   id_facture INT NOT NULL AUTO_INCREMENT,
   date_facture DATETIME NOT NULL,
   total DECIMAL(15,2) NOT NULL,
   id_utilisateur INT NOT NULL,
   adresse VARCHAR(300) NOT NULL,
   numero_rue INT NOT NULL,
   pays VARCHAR(200),
   ville VARCHAR(300),
   code_postal INT,
   paiement VARCHAR(200),
   PRIMARY KEY(id_facture),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

create or replace TABLE affectation (
   id_produit INT NOT NULL AUTO_INCREMENT,
   id_categorie INT NOT NULL,
   PRIMARY KEY(id_produit, id_categorie),
   FOREIGN KEY(id_produit) REFERENCES produit(id_produit),
   FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie)
);

create or replace TABLE achat(
   id_produit INT NOT NULL,
   id_facture INT NOT NULL,
   prix DECIMAL(6,2),
   PRIMARY KEY(id_produit, id_facture),
   FOREIGN KEY(id_produit) REFERENCES produit(id_produit),
   FOREIGN KEY(id_facture) REFERENCES facture(id_facture)
);
```
### Procédures
```sql
DELIMITER &&
create or replace procedure boughtFromUser (IN idproduit INT, IN userMail VARCHAR(200), OUT res INT)
BEGIN 
select count(achat.id_produit) into res
from achat 
inner join facture on facture.id_facture = achat.id_facture  
inner join utilisateur on utilisateur.id_utilisateur = facture.id_utilisateur 
where id_produit = idproduit and email = userMail; 
END&&

create or replace procedure addAchat (IN idProduit INT, IN idFacture INT, IN lePrix DECIMAL(6,2))
BEGIN 
INSERT INTO achat values(idProduit, idFacture, lePrix); 
END&&

create or replace procedure addAffectation(IN productId INT, IN categorieId INT) 
BEGIN 
INSERT INTO affectation values(productId, categorieId); 
END&&

create or replace PROCEDURE removeAffectation(IN productId INT, IN categorieId INT)
BEGIN
DELETE FROM affectation where id_produit = productId and id_categorie = categorieId;
END&&

create or replace procedure addCategorie(IN leLibelle VARCHAR(50)) 
BEGIN 
INSERT INTO categorie (libelle) values (leLibelle); 
END&&

create or replace PROCEDURE updateCategorie(IN categorieId INT, IN leLibelle VARCHAR(50))
BEGIN
UPDATE categorie SET libelle=leLibelle WHERE id_categorie=categorieId;
END&&

create or replace  PROCEDURE removeCategorie(IN categorieId INT)
BEGIN
DELETE FROM affectation where id_categorie = categorieId;
DELETE FROM categorie where id_categorie = categorieId;
END&&

create or replace procedure addFacture (IN dateFacture DATETIME, in leTotal decimal(15,2), in idUtilisateur int, in leAdresse varchar(300), in numeroRue int, in lePays varchar(200), in laVille varchar(300), in codePostal int, in lePaiement varchar(200), OUT result INT)
BEGIN
INSERT INTO facture (date_facture, total, id_utilisateur , adresse , numero_rue , pays , ville , code_postal , paiement) values (dateFacture, leTotal, idUtilisateur, leAdresse, numeroRue, lePays, laVille, codePostal, lePaiement);
SELECT LAST_INSERT_ID() INTO result;
END&&

create or replace procedure removeFacture(IN idFacture INT)
BEGIN
DELETE FROM facture WHERE id_facture=idFacture;
END&&

create or replace procedure getBoughtProductsOfUser (IN userId INT)
BEGIN
select p.* from achat a, facture f, produit p where a.id_facture = f.id_facture and a.id_produit = p.id_produit and f.id_utilisateur = userId;
END &&

create or replace  procedure addProduct(IN leTitre VARCHAR(50), IN lePrix decimal(6,2), IN laDescription VARCHAR(500), IN leDisponible INT, OUT result INT)
BEGIN
INSERT INTO produit (titre, prix, description, disponible) VALUES (leTitre, lePrix, laDescription, leDisponible);
SELECT LAST_INSERT_ID() INTO result;
END&&

create or replace procedure updateProduct(IN idProduit INT, IN leTitre VARCHAR(50), IN lePrix decimal(6,2), IN laDescription VARCHAR(500), IN leDisponible INT)
BEGIN
UPDATE produit SET titre = leTitre, prix = lePrix, description = laDescription, disponible = leDisponible WHERE id_produit = idProduit;
END&&

create or replace procedure toggleVisibility(IN idProduit INT)
BEGIN
UPDATE produit SET disponible = 1 - (select disponible from produit where id_produit = idProduit) where id_produit = idProduit;
END&&

create or replace procedure deleteProduct(IN idProduit INT)
BEGIN
DELETE FROM produit WHERE id_produit = idProduit;
END&&

create or replace procedure addUser(IN lePrenom VARCHAR(50), IN leNom VARCHAR(50), IN lePassword text, IN leEmail VARCHAR(254), in leStatus VARCHAR(50), in leNumrue VARCHAR(20), in leAdresse VARCHAR(100), in laVille VARCHAR(100), in lePostalcode VARCHAR(20), in lePays VARCHAR(20))
BEGIN
insert into utilisateur (nom, prenom, password, email, status, numrue, adresse, ville, postalcode, pays) VALUES (lePrenom, leNom, lePassword, leEmail, leStatus, leNumrue, leAdresse, laVille, lePostalcode, lePays);
END&&

create or replace procedure updateUser(IN idUser INT, IN leNom VARCHAR(50), IN lePrenom VARCHAR(50), IN lePassword text, IN leEmail VARCHAR(254), in leStatus VARCHAR(50), in leNumrue VARCHAR(20), in leAdresse VARCHAR(100), in laVille VARCHAR(100), in lePostalcode VARCHAR(20), in lePays VARCHAR(20))
BEGIN
update utilisateur set prenom=lePrenom, nom=leNom, email=leEmail, password=lePassword, status=leStatus, numrue=leNumrue, adresse=leAdresse, ville=laVille, postalcode=lePostalcode, pays=lePays where id_utilisateur = idUser;
END&&

create or replace procedure activeUser(IN idUser INT, IN leEtat VARCHAR(20))
BEGIN
update utilisateur set etat=leEtat where id_utilisateur = idUser;
END&&
DELIMITER ;
```