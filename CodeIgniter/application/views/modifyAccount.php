<?php

$prenom = empty(set_value('prenom')) ? $this->session->user["prenom"] : set_value('prenom');
$nom = empty(set_value('nom')) ? $this->session->user["nom"] : set_value('nom');
$email = empty(set_value('email')) ? $this->session->user["email"] : set_value('email');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >

    <title>Modifier mon compte</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>
    <?php echo form_open('user/modify'); ?>
    <div class="form-container">

            <div class="form-head">
                <h1>Modifier mes informations</h1>
            </div>

            <div class="form-input">         
                    <div class="first-name">
                        <label for="first-name" class="labelTypo" size="30">Prénom</label><br>
                        <input class="input" type="text" name="prenom" value="<?= $prenom ?>" required>
                        <?php echo form_error('prenom'); ?>
                    </div>
                    <div class="name">
                        <label for="name" class="labelTypo" size="30" >Nom</label><br>
                        <input class="input" type="text" name="nom" value="<?= $nom ?>" required>
                        <?php echo form_error('nom'); ?>
                    </div>
                <div class="email">
                    <label for="email" class="labelTypo" size="30" >Email</label><br>
                    <input class="input" type="email" name="email" value="<?= $email ?>" required>
                    <?php echo form_error('email'); ?>
                </div>

                <div class="password">
                    <label for="password" class="labelTypo" size="30" >Mot de passe actuel</label><br>
                    <input class="input" type="password" name="password" value="<?= set_value('password'); ?>"required>
                    <?php echo form_error('password'); ?>
                </div>

                <div class="password">
                    <label for="new-password" class="labelTypo" size="30" >Modifier mon mot de passe (non obligatoire)</label><br>
                    <input class="input" type="password" name="new-password">
                    <?php echo form_error('new-password'); ?>
                </div>

                <div class="confirm-password">
                    <label for="confirm-new-password" class="labelTypo" size="30" >Confirmer le nouveau mot de passe</label><br>
                    <input class="input" type="password" name="confirm-new-password">
                    <?php echo form_error('confirm-new-password'); ?>
                </div>

            </div>

            <div class="form-btn">
                <button class="btn btn-main"type="submit">Appliquer les modifications</button>
            </div>
        </div>
    </form>
    <div class="back-btn">
        <a href="<?= site_url("user/account") ?>" target="_parent">
            <button class="btn btn-main">Retourner sur mon compte</button>
        </a>
    </div>
</body>
</html>