
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href= <?= base_url("css/typographie.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/product.css") ?>>


    <title>Contact</title>
</head>
<body>
    
    <?php require_once ('header.php'); ?>

    <div class="product">

        <div class="images">
            <!--
            <div class="three-images">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
            </div>
        
            <div class="main_image">
            </div>
            -->
            <img class="main-image" src="<?= base_url("assets/image/default-img.png") ?>" alt="">
        </div>


        <div class="description">
            <div class="model" >
                <h1 class ="titre"> <?= $produit->getTitre() ?> </h1>
                <p> <?= $produit->getDescription() ?> </p>
            </div>

            <div class="buy">
                <h3> <?= $produit->getPrix() ?></h3>
                <a class="link-nav" href=<?= site_url("ShoppingCart/addProduct/".$produit->getId())?>> <img src="" alt=""> Ajouter au panier</a>
            </div>
        </div>
    </div>





</body>
</html>

