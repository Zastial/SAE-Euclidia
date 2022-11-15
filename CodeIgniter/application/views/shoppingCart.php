<?php 
$date = date('d/m/Y')

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/shoppingCart.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <title>ShoppingCart</title>
</head>
<body>
    <?php require_once ('header.php'); ?>

    <div class="main-content">
        <div class="info">
            <h1>Panier</h1>
            <p><?= $date ?> </p>
        </div>
        
    
        <div class="shopping-cart-list">
            <?php foreach($produits as $prod) :?>
                <div class="shopping-cart-product">
                    <img class="image-model" src="<?= base_url("assets/image/default-img.png") ?>" alt="default image">
                    <!--<img src="       $prod->getId()?>" alt="modèle  $prod->getTitre() ?>"> -->
                    <p><?= $prod->getTitre() ?></p>
                    <p><?= $prod->getPrix() ?> €</p>
                    <a href="<?= site_url("ShoppingCart/removeProduct/".$prod->getId())?>"><img class="icon-delete" src="<?=base_url("assets/icon/icon-delete.svg") ?>" alt="delete bouton"></a>   
                </div>
            <?php endforeach; ?>
        </div>


        <button class="btn btn-main">Passer la commander</button>
    </div>

</body>
</html>