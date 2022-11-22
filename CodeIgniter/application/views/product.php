
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



    <title>Contact</title>
</head>
<body>
    
    <?php require_once ('header.php'); ?>
    
    <div class="return">
        <a class="link-nav" href=<?= site_url("Product/find")?>> <img src="" alt=""> < Retour </a>
    </div>


    <div class="product">

        <div class="images">
            <img class="main-image" src="<?= base_url("assets/image/default-img.png") ?>" alt="">
        </div>


        <div class="description">
            <div class="model" >
                <h1 class ="titre"> <?= $produit->getTitre() ?> </h1>
                <p> <?= $produit->getDescription() ?> </p>
            </div>

            <div class="buy">
                <h3> <?= $produit->getPrix() ?> €</h3>
                <?php if (!$incart) : ?>
                    <a class="link-nav" href=<?= site_url("ShoppingCart/addProduct/".$produit->getId())?>>Ajouter au panier</a>
                <?php else: ?>
                    <a class="link-nav" href=<?= site_url("shoppingCart") ?>>Voir mon panier</a>
                <?php endif; ?>
            </div>
        </div>
    </div>





</body>
</html>

