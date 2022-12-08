use website;

INSERT INTO utilisateur 
   (prenom, nom, password, email, status)
VALUES
   ('Louis', 'Painter', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6', 
   'louis.nolan.painter@gmail.com', 'Administrateur'),

   ('Martin', 'Schreiber', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
   'email@gmail.com', 'Administrateur'),

   ('Alexandre', 'Carrrrrol', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
   'email2@gmail.com', 'Utilisateur'),

   ('Admin', 'Monsieur', '$2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6', 'admin@gmail.com', 'Administrateur');

insert into produit (titre, prix, description, disponible) 
values 
   ('Default Cube',60.3,'Default Blender cube - can not get better!',1),
   ('Monke',213.4,'Hmmmmmm.... Monke.',1),
   ('Crewmate',69.99,'STOP POSTING ABOUT AMONG US',1);

insert into categorie (libelle) 
values 
   ('meuble'),
   ('high-tech'),
   ('avion');
insert into affectation (id_produit, id_categorie) 
values 
   (3, 2),
   (1, 1),
   (2, 1),
   (2, 2);