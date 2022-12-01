<?php 
$date = date('d/m/Y');
$disabled = empty($this->session->cart);
$connected = (isset($this->session->user)) ? true : false;
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
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

    <title>ShoppingCart</title>
</head>
<body>
    <?php require_once ('header.php'); ?>
    
    <section>

        <div class="cart-container">
            <div class="cart">
                <div class="info">
                    <h1>Panier</h1>
                    <p><?= $date ?> </p>
                </div>
                
            
                <div class="shopping-cart-list">
                    <?php foreach($produits as $prod) :?>
    
                        <div class="shopping-cart-product" style="cursor:pointer">
                            <div class="shopping-cart-content" onclick='location.href="<?= site_url("Product/display/".$prod->getId())?>"'>
                                <img class="image-model" src="<?= base_url("assets/image/default-img.png") ?>" alt="default image">
                                <p><?= $prod->getTitre() ?></p>
                                <p><?= $prod->getPrix() ?> €</p>
                            </div>
                            
                            <div class="link-delete" onclick='location.href="<?= site_url("ShoppingCart/removeProduct/".$prod->getId())?>"'>
                                <a><img class="icon-delete" src="<?=base_url("assets/icon/icon-delete.svg") ?>" alt="delete bouton"></a>   
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
    
                <div class='order'>
                    <?php if(count($produits)==0) : ?>
                        
                        <button class="btn btn-main btn-orange btn-disabled" disabled> Passer la commande </button>
                        <button class='btn btn-main btn-orange btn-disabled' disabled> Vider le Panier </button>
                        
                        <?php elseif ($connected) : ?>
                            
                            <a href='<?= site_url("ShoppingCart/orderCommand") ?>'><button class='btn btn-main btn-orange'> Passer la commande </button></a>
                            <a href='<?= site_url("ShoppingCart/emptyCart") ?>'><button class='btn btn-main btn-orange'> Vider le Panier </button></a>
                            
                        <?php else :?>
                            <a href='<?= site_url("user/login") ?>'><button class='btn btn-main btn-orange'> Connectez-vous pour passer une commande   </button></a>
                            <a href='<?= site_url("ShoppingCart/emptyCart") ?>'><button class='btn btn-main btn-orange'> Vider le Panier </button></a>
                    <?php endif; ?>
                </div>
            </div>
    
            <div class='order-total'>
                <h1>Total</h1>
                <?php 
                    $total = 0
                ?>
                <?php foreach($produits as $prod) :?>
                    <div class="produit-total">
                        <p><?= $prod->getTitre() ?></p>
                        <p><?= $prod->getPrix() ?> €</p>
                        <?php 
                            $total += $prod->getPrix()
                        ?>
                    </div>
                <?php endforeach; ?>
                <p>Total = <?= $total ?> €</p>
            </div>
        </div>




        
    </section>


</body>

    <?php require_once('footer.php'); ?>

</html>