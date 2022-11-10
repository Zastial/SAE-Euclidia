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