
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href=<?= base_url("css/inscription-connexion.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>
    <link rel="stylesheet" href="<?= base_url("css/components.css") ?>">
    <link rel="shortcut icon" type="image/x-icon" href=<?=base_url("assets/icon/favicon.ico");?>>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Connexion</title>
</head>
<body>
    <?php require_once(APPPATH.'views/error.php'); ?>

    


    <a href=<?= site_url("Home") ?>>
        <img src="/assets/image/logo_euclidia.svg" alt="Euclidia" id="euclidia-icon-header" style="width: 12rem;">
    </a>

        
    <?php echo form_open('user/login'); ?>
        
        <div class="form-container">

            <h1 class="h1Typo">Connexion</h1>

            <div class="form-content-connexion">
                <div class="connexion-email">
                    <div class="form-input">
                        <div class="input-container">
                            <label for="email" class="labelTypo require" size="30" required>Email</label>
                            <div class="input">
                                <img class="input-icon" src="<?=base_url("assets/icon/icon-email.svg")?>" alt="">
                                <input class="input-with-icon" type="email" name="email" id="email" value="<?= set_value('email'); ?>" required>
                            </div>
    
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="connexion-password">
                    <div class="form-input">
                        <label for="password" class="labelTypo require">Mot de passe</label>
                        <div class="input-container">
                            <div class="input">
                                <img class="input-icon" src="<?=base_url("assets/icon/icon-lock.svg")?>" alt="">
                                <input class="input-with-icon" type="password" name="password" id="password" value="<?= set_value('password'); ?>" required>
                            </div>
                            <?php echo form_error('password'); ?>
                        </div>
                    </div>
                </div>

                <div class="g-recaptcha" data-sitekey="6Lcn6GMjAAAAAJwRI1TOH5YVNmHZnazq_YGUgsOX"></div>
                <?php echo form_error('g-recaptcha'); ?>

                
            </div>
            
        <button class="btn btn-orange btn-main" type="submit"> Se connecter</button>

        <p>Vous n'êtes pas inscrit ? <a href=<?= site_url("user/register"); ?>> S'inscrire</a></p>
      
        </div>
    </form>




    <script src="<?=base_url("js/dark_mode.js")?>"></script>
</body>
</html>
