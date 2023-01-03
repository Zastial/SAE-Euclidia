DELIMITER &&
create procedure addAffectation(IN productId INT, IN categorieId INT) 
BEGIN 
INSERT INTO affectation values(productId, categorieId); 
END&&
DELIMITER ;
DELIMITER &&
CREATE PROCEDURE removeAffectation(IN productId INT, IN categorieId INT)
BEGIN
DELETE FROM affectation where id_produit = productId and id_categorie = categorieId;
END&&
DELIMITER ;
