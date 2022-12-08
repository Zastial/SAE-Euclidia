DELIMITER &&
create procedure getBoughtProductsOfUser (IN userId INT)
BEGIN
select p.* from achat a, facture f, produit p where a.id_facture = f.id_facture and a.id_produit = p.id_produit and f.id_utilisateur = userId;
END &&
DELIMITER ;