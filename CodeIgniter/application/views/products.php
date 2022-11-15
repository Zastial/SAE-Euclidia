
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
    <title>Modèles 3D</title>
</head>
<body>
    
    <?php require_once ('header.php'); ?>

    <div class="main-content">
        
        
        <div class="search">

            <div class="search-bar">
                <input type="text" name="rechercher" id="rechercher" placeholder="Rechercher">
            </div>

            <div class="categories" id="categories">
                <?php foreach ($categories as $cat): ?>
                    <input type="checkbox" id=<?= $cat->getId() ?>>
                        <label for="checkbox"><?=$cat->getLibelle()?></label>
                    </input>
                <?php endforeach; ?>
            </div>
            <button id="filter">Appliquer les filtres</button>
            <button id="reset">Réinitialiser les filtres</button>
        </div>
        
        
        <div class="grid-products" id="produits">
            <?php require_once('productsContent.php') ?>
        </div>
    </div>











    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">

        $(function() {
            $('#reset').click(function() {
                
                $('#categories').find('input[type=checkbox]:checked').removeAttr('checked');
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
</html>

