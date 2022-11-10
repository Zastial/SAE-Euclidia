
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
    <div class="logo">
        <h2> logo</h2>
    </div>

    <div class="form-head">
        <h1>Inscription</h1>
    </div>
    <form action=<?= site_url("User/registerCheck"); ?> method="post">
        
        <div class="form-input">
            <div class="user-info">
                <div class="name">
                    <label for="name">Nom</label>
                    <input class="input" type="text" id="name" require>
                </div>
                <div class="first-name">
                    <label for="first-name">Prénom</label>
                    <input class="input" type="text" id="first-name" require>
                </div>
            </div>

            <div class="email">
                <label for="email" id="email" pattern=".+@globex\.com" size="30" required>Email</label>
                <input class="input" type="email" id="email" require>
            </div>


            <div class="password">
                <label for="password">Mot de passe</label>
                <input class="input" type="password" id="password" require>
            </div>
        </div>


        <div class="form-btn">
            <button type="submit">S'inscrire</button>
        </div>

        <div class="form-inscription-link">
            <h4>Vous êtes déjà membre ?</h4>
            <a href=<?= site_url("user/login"); ?>>Se connecter</a>
        </div>
    </form>

    <div class="bars">
        <div class="bar-black"></div>
        <div class="bar-gey"></div>
        <div class="bar-orange"></div>
    </div>
</body>
</html>