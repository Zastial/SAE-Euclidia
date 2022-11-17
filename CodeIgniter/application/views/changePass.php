<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    
    
    <title>Changer de mot de passe</title>
</head>

<body>
    <?php require_once('header.php'); ?>
    
    <form action="<?= site_url("User/checkPassChange") ?>" method="post">
        <div class="form-input">
            <label for="oldpw">Mot de passe actuel</label>
            <input class="input" type="password" name="oldpass" required>
            <label for="newpw">Nouveau mot de passe</label>
            <input class="input" type="password" name="newpass" required>
        </div>
        <div class="form-btn">
            <button type="submit">Modifier le mot de passe</button>
        </div>
    </form>
</body>
</html>