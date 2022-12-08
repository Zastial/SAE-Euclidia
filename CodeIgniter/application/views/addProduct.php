<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/tabs.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

    <title>Admin-AddProduct</title>
    <!--<link rel="icon" size="24x24"href="/assets/image/logoEuclidia.png" type="image/png">-->
</head>
<body>
    <?php require_once('error.php'); ?>

    <?php require_once('header.php'); ?>

    <section>

        <?php echo form_open('admin/addProduct'); ?>
        

        <div class="return">
            <a class="link-nav" href=<?= site_url("Admin/index")?>> <img src="" alt=""> < Retour </a>
        </div>
        
            <h1>Ajouter un Produit</h1>

            <div >
                
                <div class="nom">
                    <label for="name" class="labelTypo" size="30" required>Nom du Produit</label>
                    <input class="" type="text" name="name" required>
                </div>
                
                <div class="prix">
                    <label for="price" class="labelTypo" size="30" required>Prix du Produit</label>
                    <input class="" type="number" step="0.01" name="price" required>
                </div>
                
                <div class="desc">
                    <label for="description" class="labelTypo" size="30" required>Description du Produit</label>
                    <textarea type="text" name="description" required></textarea>
            
                </div>

            <div class="dispo">
                <label for="disponible">Disponibilité du produit</label>
                <select name="disponible" id="disponible">
                    <option value="oui">oui<option>
                    <option value="oui">non<option>
                </select>
                
            </div>
            
            <div class="categories">
                <?php foreach($categories as $categorie): ?>
                    <input type="checkbox" id="categories" name="categories[]" value="<?php echo $categorie->getId(); ?>">
                    <label for="categorie"><?php echo $categorie->getLibelle(); ?></label>
                <?php endforeach ?>
            </div>
        
            <div class= "upload">
                    <input type="file" name="usefile" accept="image/png, image/jpeg">
            </div>
            
            <div class="validation">
                <button class="btn btn-orange btn-main"type="submit">Créer un nouveau produit</button>
            </div>
            
        </form>



    </section>

   
</body>
<footer>
<?php require_once('footer.php'); ?>
</footer>
</html>