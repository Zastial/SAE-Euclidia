<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/account.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/shoppingCart.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/commandes.css") ?>>

    <title>Account</title>
</head>
<body>

    <?php require_once('header.php'); ?>
    <div class = "commandes-container">
        <?php foreach($p as $prod): ?>
            <div class="shopping-cart-product" style="cursor:pointer">
                            <div class="shopping-cart-content" <?= $prod->getDisponible()?"onclick='location.href=\"" . site_url("Product/display/".$prod->getId())."\"'":""?>>
                                <img class="image-model" src="<?= base_url("assets/image/default-img.png") ?>" alt="default image">
                                <p><?= $prod->getTitre() ?></p>
                                <p><?= $prod->getPrix() ?> €</p>
                            </div>

                            <div class="link-delete" <?= $prod->getDisponible()?"onclick='location.href=\"" . site_url("Product/display/".$prod->getId())."\"'":""?>>
                                <?php if($prod->getDisponible()){ ?>
                                    <a><img class="icon-show" src="<?=base_url("assets/icon/icon-download.svg") ?>" alt="show product"></a>
                                <?php } else { ?>
                                    <a><img class="icon-unavailable" src="<?=base_url("assets/icon/icon-download.svg") ?>" alt="product unavailable"></a> 
                                <?php } ?>
                            </div>

                            <div class="link-download" onclick='location.href="<?= site_url("Product/download/".$prod->getId())?>"'>
                                <a><img class="icon-delete" src="<?=base_url("assets/icon/icon-download.svg") ?>" alt="download bouton"></a>   
                            </div>
                        </div>
        <?php endforeach; ?>

        </div>
</body>
</html>