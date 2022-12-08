
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

                <div class="filters">
                    <h1>Trie des produits :</h1>
                    <select name="trie" id="trie">
                        <option value="">- Aucun filtre -</option>
                        <option value="prix-croissant">Trie par prix croissant</option>
                        <option value="prix-décroissant">Trie par prix décroissant</option>
                    </select>
                    
                </div>


                <div class="price">
                    <h2>Prix</h2>
                    <div class="price-container" id="price">
                        <div class="price-left">
                            <label for="min">Prix minimum</label>
                            <input id="price-min"type="number" min=0 max=9999 value=0 oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" >
                        </div>
                        <div class="price-right">
                            <label for="max">Prix maximum</label>
                            <input id="price-max" type="number" min=0 max=9999 value=9999 oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" >
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
    <script src="<?php echo base_url("js/notiflix-aio-3.2.5.min.js"); ?>"></script>
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
            var idCategories = [];
            for (var i = 0; i < checkedCategories.length; i++) idCategories.push(checkedCategories[i].id);

            var idFiltre = $('#trie').val();
            var min = parseInt(document.getElementById("price-min").value);
            var max = parseInt(document.getElementById("price-max").value);

            if (min > max || min < 0 || max < 0) {
                $('#price-min').addClass('invalid');
                $('#price-max').addClass('invalid');      
                Notiflix.Notify.failure('truc', {showOnlyTheLastOne:true, timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});
                return;  
            } else {
                $('#price-min').removeClass('invalid');
                $('#price-max').removeClass('invalid'); 
            }

            var post_data = {
                'categories': idCategories,
                /**'filtre' : idFiltre,
                'prix-min' : prixMin,
                'prix-max' : prixMax*/
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

