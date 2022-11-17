
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/typographie.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/inscription.css") ?>>

    <title>Inscription</title>
</head>
<body>
<?php require_once('error.php'); ?>
    <a href=<?= site_url("Home")?> >
        <h2> logo</h2>
    </a>

    
    <form action=<?= site_url("User/registerCheck"); ?> method="post">
        <div class="form-container">

            <div class="form-head">
                <h1>Inscription</h1>
            </div>

            <div class="form-input">         
                    <div class="first-name">
                        <label for="first-name" class="labelTypo" size="30">Prénom</label><br>
                        <input class="input" type="text" name="first-name" required>
                    </div>
                    <div class="name">
                        <label for="name" class="labelTypo" size="30" >Nom</label><br>
                        <input class="input" type="text" name="name" required>
                    </div>
                <div class="email">
                    <label for="email" class="labelTypo" size="30" >Email</label><br>
                    <input class="input" type="email" name="email" required>
                </div>


                <div class="password">
                    <label for="password" class="labelTypo" size="30" >Mot de passe</label><br>
                    <input class="input" type="password" name="password" required>
                </div>

                <div class="confirm-password">
                    <label for="confirm-password" class="labelTypo" size="30" >Confirmer le mot de passe</label><br>
                    <input class="input" type="confirm-password" name="confirm-password" required>
                </div>

            </div>


            <div class="form-btn">
                <button class="btn btn-main"type="submit">S'inscrire</button>
            </div>
        </div>
        
    </form>

    <div class="form-inscription-link">
            <h4>Vous êtes déjà membre ?</h4>
            <a href=<?= site_url("user/login"); ?>>Se connecter</a>
        </div>

        
    <div class="bars">
        <div class="bar-black"></div>
        <div class="bar-gey"></div>
        <div class="bar-orange"></div>
    </div>
</body>
</html>