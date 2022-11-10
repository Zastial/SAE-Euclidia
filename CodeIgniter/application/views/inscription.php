
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Inscription</title>
</head>
<body>
    <a href=<?= site_url("Home")?> >
        <h2> logo</h2>
    </a>

    <div class="form-head">
        <h1>Inscription</h1>
    </div>
    <form action=<?= site_url("User/registerCheck"); ?> method="post">
        <div class="form-input">         
                <div class="first-name">
                    <label for="prenom">Prénom</label>
                    <input class="input" type="text" name="prenom" required>
                    <?php 
                        if (isset($error) && $error == true) {
                            echo "Inscription impossible, merci d'utiliser un email différent.";
                        }
                    ?>
                </div>
                <div class="name">
                    <label for="nom">Nom</label>
                    <input class="input" type="text" name="nom" required>
                </div>
            <div class="email">
                <label for="email" id="email" pattern=".+@globex\.com" size="30" required>Email</label>
                <input class="input" type="email" name="email" required>
            </div>


            <div class="password">
                <label for="password">Mot de passe</label>
                <input class="input" type="password" name="password" required>
            </div>
        </div>


        <div class="form-btn">
            <button type="submit">S'inscrire</button>
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