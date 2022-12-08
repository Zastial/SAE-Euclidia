use website;

DELIMITER // 
create or replace supprimer_facture after delete on ACHAT for each row 
BEGIN 
delete from facture where facture.id_facture = OLD.id_facture; 
end 
//
DELIMITER;
