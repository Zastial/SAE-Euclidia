use website;

create or replace trigger supprimer_utilisateur after delete on FACTURE for each row

    BEGIN
        delete from utilisateur where (:OLD.id_utilisateur = utilisateur.id_utilisateur);
        delete from favori where (:OLD.id_utilisateur = favori.id_utilisateur);
    end;

