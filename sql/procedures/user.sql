DELIMITER &&
create or replace procedure addUser(IN lePrenom VARCHAR(50), IN leNom VARCHAR(50), IN lePassword text, IN leEmail VARCHAR(254), in leStatus VARCHAR(50), in leNumrue VARCHAR(20), in leAdresse VARCHAR(100), in laVille VARCHAR(100), in lePostalcode VARCHAR(20), in lePays VARCHAR(20))
BEGIN
insert into utilisateur (nom, prenom, password, email, status, numrue, adresse, ville, postalcode, pays) VALUES (lePrenom, leNom, lePassword, leEmail, leStatus, leNumrue, leAdresse, laVille, lePostalcode, lePays);
END&&
create or replace procedure updateUser(IN idUser INT, IN leNom VARCHAR(50), IN lePrenom VARCHAR(50), IN lePassword text, IN leEmail VARCHAR(254), in leStatus VARCHAR(50), in leNumrue VARCHAR(20), in leAdresse VARCHAR(100), in laVille VARCHAR(100), in lePostalcode VARCHAR(20), in lePays VARCHAR(20))
BEGIN
update utilisateur set prenom=lePrenom, nom=leNom, email=leEmail, password=lePassword, status=leStatus, numrue=leNumrue, adresse=leAdresse, ville=laVille, postalcode=lePostalcode, pays=lePays where id_utilisateur = idUser;
END&&
create or replace procedure activeUser(IN idUser INT, IN leEtat VARCHAR(20))
BEGIN
update utilisateur set etat=leEtat where id_utilisateur = idUser;
END&&
DELIMITER ;