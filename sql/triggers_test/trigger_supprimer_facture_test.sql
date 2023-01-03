use website_test;

create or replace trigger supprimer_facture after delete on achat for each row 
delete from facture where facture.id_facture = OLD.id_facture; 
