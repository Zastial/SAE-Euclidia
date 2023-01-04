<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/modifyAddress.css") ?> >

    <title>Modifier l'adresse</title>
</head>
<body>
    <?php require_once('error.php'); ?>

    <?php require_once('header.php'); ?>
    <section>

         <div class="return-previous-page">
            <?php
                $url = site_url("product/find");
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
                }
            ?>
            <a class="btn btn-orange" href=<?= $url ?>> <img src="" alt=""> < Retour</a>
            <!-- class="link-nav"-->
        </div>   

        <?php echo form_open('user/modifyAddress/'); ?>
            <div class="form-container">
            <h1>Modifier son adresse</h1>
                <div class="form-input-modifyAddress">
                    
                    <div class="num-rue">
                        <label for="numerorue" class="labelTypo" size="30" required>Numéro de rue</label>
                        <input class="" type="number" min="0"name="numerorue" required>
                    </div>
                    
                    <div class="adresse">
                        <label for="adresse" class="labelTypo" size="30" required>Adresse</label>
                        <input class="" type="text" name="adresse" required>
                    </div>
                    
                    <div class="ville">
                        <label for="ville" class="labelTypo" size="30" required>Ville</label>
                        <input class="" type="text" name="ville" required>
                    </div>

                    <div class="code-postal">
                        <label for="codepostal" class="labelTypo" size="30" required>Code Postal</label>
                        <input class="" type="number" min="0" name="codepostal" required>
                    </div>

                    <div class="pays">
                        <label for="pays" class="labelTypo" size="30" required>Pays</label>
                        <input class="" type="text" name="pays" required>
                    </div>

                
                <div class="validation">
                    <button class="btn btn-orange btn-main"type="submit">Changer l'adresse</button>
                </div>
            </div>
        </form>
    </section>

</body>
<?php require_once('footer.php'); ?>
</html>