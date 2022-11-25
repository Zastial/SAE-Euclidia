
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
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    
    <title>Connexion</title>
</head>
<body>
    <?php require_once('error.php'); ?>

    


    <a href=<?= site_url("Home")?> >
        <h2> logo</h2>
    </a>

        
            
    <?php echo form_open('user/login'); ?>
        
    
    
        <div class="form-container">

            <h1 class="h1Typo">Connexion</h1>

            <div class="form-content-connexion">
                <div class="connexion-email">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="email" class="labelTypo" size="30" required>Email</label>
                            <div class="input">
                                <span class="material-symbols-outlined">alternate_email</span>                        
                                <input class="input-with-icon" type="email" name="email" id="email" value="<?= set_value('email'); ?>" required>
                            </div>
    
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="connexion-password">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="password" class="labelTypo">Mot de passe</label>
                            <div class="input">
                                <span class="material-symbols-outlined">lock</span>
                                <input class="input-with-icon" type="password" name="password" id="password" value="<?= set_value('password'); ?>" required>
                            </div>
                            <?php echo form_error('password'); ?>
                        </div>
                    </div>

                </div>
                

            </div>
            
                    <button class="btn btn-orange btn-main" type="submit"> Se connecter</button>
        
                    <p>Vous n'êtes pas inscrit ? <a href=<?= site_url("user/register"); ?>> S'inscrire</a></p>
                    


            
        </div>
    </form>

    <div class="bars">
        <div class="bar-black"></div>
        <div class="bar-grey"></div>
        <div class="bar-orange"></div>
    </div>
</body>
</html>