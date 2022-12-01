<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/tabs.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

    <title>Modifier l'adresse</title>
</head>
<body>
    <?php require_once('error.php'); ?>

    <?php require_once('header.php'); ?>
    <section>
        <?php echo form_open('user/modifyAddress/'); ?>

            <h1>Ajouter un Produit</h1>

                <div >
                    
                    <div class="num-rue">
                        <label for="numerorue" class="labelTypo" size="30" required>Numéro de rue</label>
                        <input class="" type="text" name="numerorue" required>
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
                        <input class="" type="text" name="codepostal" required>
                    </div>

                    <div class="pays">
                        <label for="pays" class="labelTypo" size="30" required>Pays</label>
                        <input class="" type="text" name="pays" required>
                    </div>

                
                <div class="validation">
                    <button class="btn btn-orange btn-main"type="submit">Changer l'adresse</button>
                </div>

        </form>
    </section>

</body>
</html>