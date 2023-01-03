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
DELIMITER &&
create procedure addAchat (IN idProduit INT, IN idFacture INT, IN lePrix DECIMAL(6,2))
BEGIN 
INSERT INTO achat values(idProduit, idFacture, lePrix); 
END&&
DELIMITER ;