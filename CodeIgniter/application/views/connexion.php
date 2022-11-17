
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/typographie.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/connexion.css") ?>>
    <title>Connexion</title>
</head>
<body>
<?php require_once('error.php'); ?>
    <a href=<?= site_url("Home")?> >
        <h2> logo</h2>
    </a>

    <?php echo form_open('user/login'); ?>
        <div class="form-container">
            <div class="form-head">
                <h1 class="h1Typo">Connexion</h1>
            </div>

            <div class="form-input">
                <div class="email">
                    <label for="email" class="labelTypo" size="30" required>Email</label><br>
                    <input class="input" type="email" name="email" value="<?= set_value('email'); ?>" required>
                    <?php echo form_error('email'); ?>
                </div>
                <div class="password">
                    <label for="password" class="labelTypo">Mot de passe</label><br>
                    <input class="input" type="password" name="password" value="<?= set_value('password'); ?>" required>
                    <?php echo form_error('password'); ?>
                </div>
            </div>


            <div class="form-btn">
                <button class="btn btn-main"> Se connecter</button>
            </div>

            <div class="form-inscription-link">
                <p class="pTypo">Vous n'êtes pas inscrit ?</p>

                <a href=<?= site_url("user/register"); ?> class="aTypo"> S'inscrire</a>
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