<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href=<?= base_url("css/modifCategorie.css")?>>
    <title>modifCategorie</title>
</head>
<body>
    <?php require_once('error.php'); ?>
    <?php require_once('header.php'); ?>
    
    <section>


        <?php
            $url = site_url("admin/categories");
            if (isset($_SERVER['HTTP_REFERER'])) {
                $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
            }
        ?>
        <a class="btn btn-orange" href="<?=$url?>"> <img src="" alt=""> < Retour </a>
        <?php echo form_open("admin/modifCategorie/".$categorie->getId()) ?>
        <h1>Ajouter une catégorie</h1>
    
            <label for="name">Nom de la categorie</label>
            <input type="text" name="name" id="name" value="<?php echo $categorie->getLibelle(); ?>">
    
    
            <input class="btn btn-main btn-orange" type="submit" value="Modifier la catégorie">

        </form>
    </section>


    <?php require_once('footer.php'); ?>

    
</body>
</html>