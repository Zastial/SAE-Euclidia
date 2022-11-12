
<link rel="stylesheet" href="<?= base_url("css/grid-products.css") ?>">

<body>

    <div class="grid-products" id="produits">
        
        <?php foreach($produits as $prod) :?>
            <?php $id = $prod->getId(); ?>
            <a class="card-link" href="<?=site_url("Product/display/").$id ?>">
                <div class="card-container">
                    <img src="<?= base_url("assets/image/default-img.png") ?>" alt="modèle <?= $prod->getTitre() ?>">
                    <div class="card-description">
                        <p><?= $prod->getPrix() ?>  €</p>
                        <p><?= $prod->getTitre() ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>

    </div>

</body>