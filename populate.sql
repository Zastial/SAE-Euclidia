use website;

INSERT INTO utilisateur 
   (id_utilisateur, prenom, nom, password, email, status)
VALUES
   (0, 'Louis', 'Painter', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6', 
   'louis.nolan.painter@gmail.com', 'Administrateur'),

   (1, 'Martin', 'Schreiber', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
   'email@gmail.com', 'Administrateur'),

   (2, 'Alexandre', 'Carrrrrol', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
   'email2@gmail.com', 'Utilisateur');

insert into produit values (1,'Default Cube',60.3,'Default Blender cube - can not get better!',1);
insert into produit values (2,'Monke',213.4,'Hmmmmmm.... Monke.',1);
insert into produit values (3,'Crewmate',69.99,'STOP POSTING ABOUT AMONG US',1);

insert into categorie (id_categorie, libelle) 
values 
   (0, 'meuble'),
   (1, 'high-tech'),
   (2, 'avion');
insert into affectation (id_produit, id_categorie) 
values 
   (3, 1),
   (1, 0),
   (2, 0),
   (2, 1);