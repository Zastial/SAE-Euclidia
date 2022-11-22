
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/typographie.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

    <title>Contact</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>

    <div >
        <h2>Nous contacter</h2>
        <div>
            <p> Email : contact@euclidia.com </p>
            <p> Téléphone : 06######## </p>
            <p> Adresse : 3 impasse de la rue </p>
            <p> 35671 Village-en-Bretagne</p>
        </div>
    </div>


    <!--A delete ou faire -->
    <div>
        <form action="">

            <div>
                <td><label for="email">Votre email :</label></td><br>
                <td><input type="email" required></td>
            </div>

            <div>
                <td><label for="object">Titre du mail :</label></td><br>
                <td><input type="text" required></td>
            </div>

            <div>
                <td><label for="message">Corps du message :</label></td><br>
                <td><input type="text" required></td>
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </div>

    <!-- end -->
</body>
</html>


