<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/productImage.css") ?>>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <title>Admin-AddProduct</title>
    
</head>
<body>
    <?php require_once('error.php'); ?>

    <?php require_once('header.php'); ?>

    <section>

        <?php echo form_open_multipart('admin/addProduct'); ?>
        

        <div class="return">
            <a class="link-nav" href=<?= site_url("admin/products")?>> <img src="" alt=""> < Retour </a>
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
                <ul id="sortable">
                    
                </ul>
                <input id="file-upload" type="file" name="userfile[]" size="20" accept="image/png, image/jpeg" multiple required>
                <input id="file-upload" type="file" name="models[]" size="20" accept="model/obj, model/mtl, application/x-3ds, model/gltf+json, model/gltf-binary, model/stl, model/mesh" multiple required>
            </div>
            
            <div class="validation">
                <button class="btn btn-orange btn-main"type="submit">Créer un nouveau produit</button>
            </div>
            
        </form>



    </section>
    <script type="text/javascript" src=<?=base_url("js/productImage.js")?>></script>
</body>
<footer>
<?php require_once('footer.php'); ?>
</footer>
</html>