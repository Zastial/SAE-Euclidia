DELIMITER &&
create or replace procedure addFacture (IN dateFacture DATETIME, in leTotal decimal(15,2), in idUtilisateur int, in leAdresse varchar(300), in numeroRue int, in lePays varchar(200), in laVille varchar(300), in codePostal int, in lePaiement varchar(200), OUT result INT)
BEGIN
INSERT INTO facture (date_facture, total, id_utilisateur , adresse , numero_rue , pays , ville , code_postal , paiement) values (dateFacture, leTotal, idUtilisateur, leAdresse, numeroRue, lePays, laVille, codePostal, lePaiement);
SELECT LAST_INSERT_ID() INTO result;
END&&
DELIMITER ;
DELIMITER &&
create procedure removeFacture(IN idFacture INT)
BEGIN
DELETE FROM facture WHERE id_facture=idFacture;
END&&
DELIMITER ;