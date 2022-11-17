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
    <form action="<?= site_url("User/checkNameChange") ?>" method="post">
        <div class="form-input">
            <label for="nom">Nom</label>
            <input class="input" type="text" name="nom" value = "<?= $this->session->user["nom"] ?>" required>
            <label for="prenom">Prenom</label>
            <input class="input" type="text" name="prenom" value = "<?= $this->session->user["prenom"] ?> " required>
            <label for="email">E-Mail</label>
            <input class="input" type="email" name="email" value = "<?= $this->session->user["email"] ?> " required>
        </div>
        <div class="form-btn">
            <button type="submit">Modifier le profil</button>
        </div>
    </form>
</body>
</html>