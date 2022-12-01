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
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>



    <title>Modèle 3D</title>
</head>
<body>
    
    <?php require_once ('header.php'); ?>
    

    <section>


        <div class="return">
            <a class="link-nav" href=<?= site_url("Product/find")?>> <img src="" alt=""> < Retour à la liste des produits</a>
        </div>
    
    
        <div class="product">
    
            <div class="product-image">
                <img class="main-image" src="<?= base_url('img/get/'.$produit->getId()) ?>" alt="">
            </div>
    
    
            <div class="product-content">
                
                <h1 class ="product-title"> <?= $produit->getTitre() ?> </h1>
                <p class="product-description"> <?= $produit->getDescription() ?> </p>
                
    
                <h3 class="product-price"> <?= $produit->getPrix() ?> €</h3>
                
                <div class="-button" class="buy">
                    <?php if ($isbought): ?>
                        <a class="link-nav a-desactived" role="link" aria-disabled="true">Déjà possédé</a>
                    <?php endif; ?>
                    <?php if (!$incart && !$isbought) : ?>
                        <a class="link-nav" href=<?= site_url("ShoppingCart/addProduct/".$produit->getId())?>>Ajouter au panier</a>
                    <?php elseif (!$isbought): ?>
                        <a class="link-nav" href=<?= site_url("shoppingCart") ?>>Voir mon panier</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>



    </section>
</body>


    <?php require_once('footer.php'); ?>

</html>

