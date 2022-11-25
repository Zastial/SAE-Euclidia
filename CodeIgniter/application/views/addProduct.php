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

    <title>Admin-AddProduct</title>
</head>
<body>
    <?php require_once('error.php'); ?>

    <section>

        <?php echo form_open('admin/addProduct'); ?>
        
        
            <h1>Ajouter un Produit</h1>
            <div class="labels">
                <div class="nom">
                    <label for="name" class="labelTypo" size="30" required>Nom du Produit</label>
                    <input class="" type="text" name="name" required>
                </div>
                <br>
                <div class="prix">
                    <label for="price" class="labelTypo" size="30" required>Prix du Produit</label>
                    <input class="" type="text" name="price" required>
                </div>
                <br>
                <div class="desc">
                    <label for="description" class="labelTypo" size="30" required>Description du Produit</label>
                    <textarea type="text" name="description" required></textarea>
                </div>
            </div>
            <div class="dispo">
                <label class="labelTypo" size="30" required>Disponible?</label>
                <input type="radio" id="oui" name="disponible" value="true" checked>
                <label for="oui"> Oui </label>
                <input type="radio" id="non" value="false" name="disponible">
                <label for="non"> Non </label>
                
            </div>
            <br>
            <div class="validation">
                <button class="btn btn-orange btn-main"type="submit">Créer un nouveau produit</button>
            </div>
            
        </form>



    </section>

   
</body>
<footer>
<?php require_once('footer.php'); ?>
</footer>
</html>