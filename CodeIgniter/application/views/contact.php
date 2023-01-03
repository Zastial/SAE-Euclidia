
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href=<?= base_url("css/contact.css") ?>>

    <title>Contact</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>

    <section>



    
        <div class="contact-all">
            <div class="contact">
                <div class='contact-info'>
                    <h2>Nous contacter</h2>
                    <div>
                        <p> Email : contact@euclidia.com</p>
                        <p> Téléphone : 06######## </p>
                        <p> Adresse : 3 impasse de la rue </p>
                        <p> 35671 Village-en-Bretagne</p>
                    </div>
                </div>
    
                <div class='contact-form'>
                    <form action="<?= site_url("Contact/sendMail") ?>" method='post'>
                        <div class="names">
                            <div>
                                <td><label class="require">Nom : </label></td><br>
                                <td><input type="text" name="nom" required></td>
                            </div>
                            <div>               
                                <td><label  class="require">Prénom :</label></td><br>
                                <td><input type="text" name="prenom" required></td>
                            </div>
                        </div>
                        <div class="mail">
                            <td><label  class="require" for="email">Votre email :</label></td><br>
                            <td><input type="email" name="email" required></td>
                        </div>
    
                        <div class="object">
                            <td><label  class="require" for="objet">Titre du mail :</label></td><br>
                            <td><input type="text" name="objet" required></td>
                        </div>
    
                        <div class="message">
                            <td><label  class="require" for="message">Corps du message :</label></td><br>
                            <td><textarea type="text" name="message" required></textarea></td>
                        </div>
                        <input class="btn btn-main btn-orange btn-send" type="submit" value="Envoyer">
                    </form>
                </div>
            </div>
        </div>






    </section>
</body>



    <?php require_once('footer.php'); ?>

</html>


