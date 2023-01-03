DELIMITER &&
create or replace procedure addCategorie(IN leLibelle VARCHAR(50)) 
BEGIN 
INSERT INTO categorie (libelle) values (leLibelle); 
END&&

DELIMITER &&
CREATE OR REPLACE PROCEDURE updateCategorie(IN categorieId INT, IN leLibelle VARCHAR(50))
BEGIN
UPDATE categorie SET libelle=leLibelle WHERE id_categorie=categorieId;
END&&

DELIMITER &&
CREATE OR REPLACE PROCEDURE removeCategorie(IN categorieId INT)
BEGIN
DELETE FROM categorie where id_categorie = categorieId;
END&&
