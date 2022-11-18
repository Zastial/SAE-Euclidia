
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

    <?php echo form_open('user/register'); ?>

        <div class="form-container">

            <div class="form-head">
                <h1>Inscription</h1>
            </div>

            <div class="form-input">         
                <div class="first-name">
                    <label for="first-name" class="labelTypo" size="30">Prénom</label><br>
                    <input class="input" type="text" name="prenom" value="<?= set_value('prenom'); ?>" required>
                    <?php echo form_error('prenom'); ?>
                </div>
                <div class="name">
                    <label for="name" class="labelTypo" size="30" >Nom</label><br>
                    <input class="input" type="text" name="nom" value="<?= set_value('nom'); ?>" required>
                    <?php echo form_error('nom'); ?>
                </div>
                <div class="email">
                    <label for="email" class="labelTypo" size="30" >Email</label><br>
                    <input class="input" type="email" name="email" value="<?= set_value('email'); ?>" required>
                    <?php echo form_error('email'); ?>
                </div>


                <div class="password">
                    <label for="password" class="labelTypo" size="30" >Mot de passe</label><br>
                    <input class="input" type="password" name="password" value="<?= set_value('password'); ?>" required>
                    <?php echo form_error('password'); ?>
                </div>

                <div class="confirm-password">
                    <label for="confirm-password" class="labelTypo" size="30" >Confirmer le mot de passe</label><br>
                    <input class="input" type="password" name="confirm-password" value="<?= set_value('confirm-password'); ?>" required>
                    <?php echo form_error('confirm-password'); ?>
                </div>

            </div>


            <div class="form-btn">
                <button class="btn btn-orange btn-main"type="submit">S'inscrire</button>
            </div>

            <div class="form-inscription-link">
                <h4>Vous êtes déjà membre ?</h4>
                <a href=<?= site_url("user/login"); ?>>Se connecter</a>
            </div>
        </div>
        
    </form>

    

        
    <div class="bars">
        <div class="bar-black"></div>
        <div class="bar-grey"></div>
        <div class="bar-orange"></div>
    </div>
</body>
</html>