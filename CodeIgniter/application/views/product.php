<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link rel="stylesheet" href=<?= base_url("css/product.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/image-zoom.css") ?>>

    <title>Modèle 3D</title>

</head>
<body>
    
    <?php require_once ('header.php'); ?>
    

    <section>


        <div class="return-previous-page">
            <?php
                $url = site_url("product/find");
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
                }
            ?>
            <a class="btn btn-orange" href=<?= $url ?>> <img src="" alt=""> < Retour à la liste des produits</a>
        </div>
    
    
        <div class="product">
            <!-- IMAGE PRINCIPALE-->
            <img class="main-image" id="main-image"src="<?= base_url('resource/picture/'.$produit->getId()) ?>" alt="" data-zoom-image>
            
            <!-- SLIDER IMAGE -->
            <div class="slider-container">
                <button class="btn-scroll btn-scroll-to-left" onclick="scrollSliderLeft()" type="button"></button>
                <div id="slider-image" class="slider-image">
                    <?php for($i=0;$i<$c;$i++){?>
                        <img class="other-image" id="<?=$i?>" src="<?= base_url('resource/picture/'.$produit->getId()."/".$i) ?>" alt="" onclick="changeImage(id)">
                    <?php } ?>
                </div>
                <button class="btn-scroll btn-scroll-to-right" onclick="scrollSliderRight()" type="button"></button>
            </div>

            
            <!-- CONTENT -->
            <div class="product-content">
                
                <h1 class ="product-title"> <?= $produit->getTitre() ?> </h1>
                <p class="product-description"> <?= $produit->getDescription() ?> </p>
                
                
                <div class="product-price">
                    <h3> <?= $produit->getPrix() ?> €</h3>
                    
                    <?php if ($isbought): ?>
                        <a class="link-nav a-desactived" role="link" aria-disabled="true" href="<?= site_url("Resource/model/".$produit->getId()) ?>">Télécharger</a>
                    <?php endif; ?>
                    <?php if (!$incart && !$isbought) : ?>
                        <a class="btn btn-black-200 btn-border-orange" href=<?= site_url("ShoppingCart/addProduct/".$produit->getId())?>>Ajouter au panier</a>
                    <?php elseif (!$isbought): ?>
                        <a class="link-nav" href=<?= site_url("shoppingCart") ?>>Voir mon panier</a>
                    <?php endif; ?>

                    
                </div>
            </div>
            

        </div>

    </section>

    


    <script src="<?= base_url("js/slider.js") ?>"></script>
</body>


    <?php require_once('footer.php'); ?>
    <script type="text/javascript" src="<?=base_url("js/image-zoom.js")?>"></script>

</html>

