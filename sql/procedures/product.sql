DELIMITER &&
create or replace procedure addProduct(IN leTitre VARCHAR(50), IN lePrix decimal(6,2), IN laDescription VARCHAR(500), IN leDisponible INT, OUT result INT)
BEGIN
INSERT INTO produit (titre, prix, description, disponible) VALUES (leTitre, lePrix, laDescription, leDisponible);
SELECT LAST_INSERT_ID() INTO result;
END&&
create procedure updateProduct(IN idProduit INT, IN leTitre VARCHAR(50), IN lePrix decimal(6,2), IN laDescription VARCHAR(500), IN leDisponible INT)
BEGIN
UPDATE produit SET titre = leTitre, prix = lePrix, description = laDescription, disponible = leDisponible WHERE id_produit = idProduit;
END&&
create procedure toggleVisibility(IN idProduit INT)
BEGIN
UPDATE produit SET disponible = 1 - (select disponible from produit where id_produit = idProduit) where id_produit = idProduit;
END&&
create procedure deleteProduct(IN idProduit INT)
BEGIN
DELETE FROM produit WHERE id_produit = idProduit;
END&&
DELIMITER ;
