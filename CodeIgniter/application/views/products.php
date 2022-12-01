
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
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    <title>Modèles 3D</title>
</head>
<body>
    <?php require_once('error.php'); ?>
    <?php require_once ('header.php'); ?>

    <section>

        <div class="main-content">
            
            
            <div class="search">
    
                <div class="input-container">
                    <div class="input">
                        <span class="material-symbols-outlined">search</span>
                        <input class="input-with-icon"type="text" name="rechercher" id="rechercher" placeholder="Rechercher">
                    </div>
                </div>
    
                <div class="categories" id="categories">
                    <h1>Catégories :</h1>
                    <?php foreach ($categories as $cat): ?>
                        <div class="one-categ">
                            <?php $categId = $cat->getId() ;?>
                            <input class="input-with-icon" type="checkbox" id=<?=$categId?> />
                            <label for=<?= $categId ?>> <?=$cat->getLibelle()?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="price">
                    <h2>Prix</h2>
                    <div class="price-container">
                        <div class="price-min">
                            <label for="min">Prix minimum</label>
                            <input id="min"type="number" min="0" max="9999" value="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                        </div>
                        <div class="price-max">
                            <label for="max">Prix maximum</label>
                            <input id="max" type="number" min="0" max="9999" value="9999" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                        </div>
                    </div>
                </div>


                <button class="btn btn-black-200 btn-large" id="filter">Filtrer</button>
                <button class="btn btn-black-200 btn-large" id="reset">Réinitialiser les filtres</button>
            </div>
            
            
            <div class="grid-products" id="produits">
                <?php require_once('productsContent.php') ?>
            </div>
        </div>

    </section>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">

        $(function() {
            $('#reset').click(function() {
                
                $('#categories').find('input[type=checkbox]:checked').prop('checked', false);
                modifyProducts();
            });

            $('#filter').click(function() {
                modifyProducts();
                
            });
        });

        function modifyProducts() {
            var checkedCategories = document.querySelectorAll('#categories input[type="checkbox"]:checked');
            var ids = [];
            for (var i = 0; i < checkedCategories.length; i++) ids.push(checkedCategories[i].id);

            var post_data = {
                'categories': ids
            };

            $.ajax({
                type: "POST",
                url: "<?= site_url("Product/getFilteredProducts") ?>",
                data: post_data,
                success: function(produits) {
                    $('#produits').html(produits);
                }
            });
        }
        
    </script>

</body>
<footer>
    <?php require_once('footer.php'); ?>
</footer>
</html>

