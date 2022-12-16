<?php 
$checked = array();
if (isset($_GET['categorie'])) {
    $checked = $_GET['categorie'];
}
$filter = 0;
if (!empty($_GET['tri'])) {
    $filter = htmlentities($_GET['tri']);
}

$name = "";
if (!empty($_GET['rechercher'])) {
    $name = htmlentities($_GET['rechercher']);
}

$min = 0;
if (!empty($_GET['price-min'])) {
    $min = intval($_GET['price-min']);
}

$max = 1000;
if (!empty($_GET['price-max'])) {
    $max = intval($_GET['price-max']);
}

if ($max < $min) {
    $min = 0;
    $max = 1000;
}
if ($min < 0) {
    $min = 0;
}
if ($max >= 1000) {
    $max = 1000;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/productsPage.css") ?>>
    <link rel="stylesheet" href="<?= base_url("css/grid-products.css") ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    <title>Modèles 3D</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php require_once('error.php'); ?>
    <?php require_once ('header.php'); ?>
    <section>

        <div class="main-content">
            <div class="search">
                <form class="form-content" method="get" action=<?= site_url("product/find")?>>
                    <div class="input-container">
                        <div class="input">
                            <span class="material-symbols-outlined">search</span>
                            <input class="input-with-icon" type="text" name="rechercher" value="<?=$name?>" id="rechercher" placeholder="Rechercher">
                        </div>
                    </div>
        
                    <div class="categories" id="categories">
                        <h1>Catégories :</h1>
                        <?php foreach ($categories as $cat): ?>
                            <div class="one-categ">
                                <?php $categId = $cat->getId() ;?>
                                <input class="input-with-icon" type="checkbox" id=<?=$categId?> name='categorie[]' value=<?=$categId?> <?php if (in_array($categId, $checked)) {echo 'checked';}?> />
                                <label for=<?= $categId ?>> <?=$cat->getLibelle()?> </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="filters">
                        <h1>Tri des produits :</h1>
                        <select name="tri" id="tri">
                            <?php 
                            
                            $options = array('- Aucun filtre -', 'Tri par prix croissant', 'Tri par prix décroissant');

                            for ($i=0;$i<count($options);$i++) {
                                $balise = "<option";
                                if ($filter == $i) {
                                    $balise = $balise . " selected";
                                } 
                                $balise = $balise . " value=\"".$i."\">".$options[$i]."</option>";
                                echo $balise;
                            }
                            
                            ?>
                        </select>
                        
                    </div>


                    <div class="price">
                        <h2>Prix</h2>
                        <div class="price-container" id="price">
                            <div class="price-left">
                                <label for="min">Prix minimum</label>
                                <input id="price-min" type="number" name="price-min" min="0"  value=<?=$min?> oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" >
                            </div>
                            <div class="price-right">
                                <label for="max">Prix maximum</label>
                                <input id="price-max" name="price-max" type="number" min="0"  value=<?=$max?> oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" >
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-black-200 btn-large" id="filter">Filtrer</button>
                    <button class="btn btn-black-200 btn-large" id="reset">Réinitialiser les filtres</button>
                </form>
            </div>
            
            
            <div class="grid-products" id="produits">
            <?php foreach($produits as $prod) :?>
                <?php $id = $prod->getId(); ?>
                <a class="card-link" href="<?=site_url("Product/display/").$id ?>">
                    <div class="card-container">
                        <img src="<?= base_url('resource/picture/'.$prod->getId()) ?>" alt="modèle <?= $prod->getTitre() ?>">
                        <div class="card-description">
                            <p class="price"><?= $prod->getPrix() ?>  €</p>
                            <p class="title"><?= $prod->getTitre() ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

            </div>
        </div>

    </section>
    <script src="<?php echo base_url("js/notiflix-aio-3.2.5.min.js"); ?>"></script>
    <script type="text/javascript">

        
        $(function() {
            $('#reset').click(function() {
                
                $('#categories').find('input[type=checkbox]:checked').prop('checked', false);
                $('#price-min').val('0');
                $('#price-max').val('1000');
                $('#rechercher').val("");
                $('#tri').prop('selectedIndex', 0);
                modifyProducts();
  
            });
        });
        
    </script>

</body>
<footer>
    <?php require_once('footer.php'); ?>
</footer>
</html>

