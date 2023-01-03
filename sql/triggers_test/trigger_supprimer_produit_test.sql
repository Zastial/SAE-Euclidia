USE website_test;

DELIMITER //

CREATE TRIGGER supprimer_produit BEFORE DELETE ON produit
FOR EACH ROW
BEGIN
    DECLARE produit_achete INT;

    select * into produit_achete from produit p
    where (select id_produit from achat a where p.id_produit = a.id_produit) = 0;
    signal sqlstate '-20001' set message_text = 'Le produit ne peut être supprimé car un achat a déjà été effectué dessus'; 

    delete from achat where (:OLD.id_facture = ACHAT.id_facture);

    Exception
    WHEN NO_DATA_FOUND THEN NULL;
    WHEN too_many_rows then
        signal sqlstate '-20002' set message_text = 'Too many rows';

END //

DELIMITER ;