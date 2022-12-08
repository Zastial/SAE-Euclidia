use website;

create or replace trigger supprimer_produit before delete on produit for each row
    DECLARE
        produit_achete produit%ROWTYPE;
    BEGIN

        select * into produit_achete from produit p
        where (select id_produit from achat a where p.id_produit = a.id_produit) = 0;
        signal sqlstate '-20001' set message_text = 'Le produit ne peut être supprimé car un achat a déjà été effectué dessus'; 

        delete from achat where (:OLD.id_facture = ACHAT.id_facture);
    
        Exception
        WHEN NO_DATA_FOUND THEN NULL;
        WHEN too_many_rows then
            signal sqlstate '-20002' set message_text = 'Too many rows'; 
    end;