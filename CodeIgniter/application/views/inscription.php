
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



    <title>Inscription</title>
</head>
<body>
<?php require_once('error.php'); ?>
    <a href=<?= site_url("Home") ?>>
        <img src="/assets/image/logoEuclidia.png" alt="Euclidia" style="width: 12rem;">
    </a>

    <?php echo form_open('user/register'); ?>

        <div class="form-container">            
            <h1>Inscription</h1>
            

            <div class="form-content-inscription">
                <div class="inscription-first-name">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="first-name" class="labelTypo require" size="30">Prénom</label>
                            <div class="input">
                                <span class="material-symbols-outlined">person</span>                        
                                <input class="input-with-icon" type="text" name="prenom" value="<?= set_value('prenom'); ?>" required>
                            </div>
                        </div>
                        <p class="text-red"><?php echo form_error('prenom'); ?></p>
                    </div>
                </div>

                <div class="inscription-last-name">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="name" class="labelTypo require" size="30" >Nom</label>
                            <div class="input">
                                <span class="material-symbols-outlined">person</span>                        
                                <input class="input-with-icon" type="text" name="nom" value="<?= set_value('nom'); ?>" required>
                            </div>
                        </div>
                        <?php echo form_error('nom'); ?>
                    </div>
                </div>
                
                <div class="inscription-email">
                    <div class="form-input">
                        <div class="input-container email">
                            <label for="email" class="labelTypo require" size="30" >Email</label>
                            <div class="input">
                                <span class="material-symbols-outlined">alternate_email</span>                        
                                <input class="input-with-icon" type="email" name="email" value="<?= set_value('email'); ?>" required>
                            </div>
                        </div>
                        <?php echo form_error('email'); ?>
                    </div>
                </div>

                <div class="inscription-password">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="password" class="labelTypo require" size="30" >Mot de passe</label>
                            <div class="input">
                                <span class="material-symbols-outlined">lock</span>                        
                                <input class="input-with-icon" type="password" name="password" value="<?= set_value('password'); ?>" required>
                            </div>
                        </div>
                        <?php echo form_error('password'); ?>
                    </div>              
                </div>
                
                <div class="inscription-password-confirmation">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="confirm-password" class="labelTypo require" size="30" >Confirmer le mot de passe</label>
                            <div class="input">
                                <span class="material-symbols-outlined">lock</span>                        
                                <input class="input-with-icon" type="password" name="confirm-password" value="<?= set_value('confirm-password'); ?>" required>
                            </div>
                        </div>
                        <p style="color: red;"><?php echo form_error('confirm-password'); ?></p>
                    </div>
                
                </div>
            
                
            </div>
            <button class="btn btn-orange btn-main"type="submit">S'inscrire</button>
            <p>Vous êtes déjà membre ? <a href=<?= site_url("user/login"); ?>>Se connecter</a></p>
            
            
            
        </div>
        
    </form>

    

        
    <div class="bars">
        <div class="bar-black"></div>
        <div class="bar-grey"></div>
        <div class="bar-orange"></div>
    </div>
</body>
</html>