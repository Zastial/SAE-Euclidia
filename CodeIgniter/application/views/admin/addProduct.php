<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= base_url("css/admin/addProduct.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/admin/productImage.css") ?>>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <title>Ajouter un produit</title>
    
</head>
<body>
    <?php require_once(APPPATH.'views/error.php'); ?>

    <?php require_once(APPPATH.'views/header.php'); ?>

    <section>

        <a class="btn btn-orange" href=<?= site_url("admin/products")?>> <img src="" alt=""> < Retour </a>
        <div class="main-content">

            <form>
                
                <h1>Ajouter un Produit</h1>
                
                <div class="form-content">

                    
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
        
                    <div class="available-container">
                        <label for="disponible">Disponibilité du produit : </label>
                        <select name="disponible" id="disponible">
                            <option value="oui">Disponible</option>
                            <option value="non">Indisponible</option>
                        </select>
                        
                    </div>
                    
                    <div class="categories">
                        <?php foreach($categories as $categorie): ?>
                            <?php $labelcategorie = $categorie->getLibelle(); ?>
                            <input type="checkbox" id="<?= $labelcategorie?>" name="categories[]" value="<?php echo $categorie->getId(); ?>">
                            <label for="<?= $labelcategorie?>"><?= $labelcategorie?></label>
                        <?php endforeach ?>
                    </div>
                
                    <div class= "upload">
                        <ul id="sortable">
                            
                        </ul>
                        <div class="file-container">
                            <label for="file-upload">Image(s) du produit : </label>
                            <input id="file-upload" type="file" name="userfile[]" size="20" accept="image/png, image/jpeg" multiple required>
                        </div>
                        <div class="file-container">
                            <label for="file-upload">Modèle 3D du produit : </label>
                            <input id="file-upload" type="file" name="models[]" size="20" accept="model/obj, model/mtl, application/x-3ds, model/gltf+json, model/gltf-binary, model/stl, model/mesh" multiple required>
                        </div>
                    </div>
                    
                    
                    <button class="btn btn-orange btn-main" type="submit">Créer un nouveau produit</button>
                    
                </div>    
            </form>

        </div>    

    </section>
    <script type="text/javascript" src=<?=base_url("js/productImage.js")?>></script>
</body>
<?php require_once(APPPATH.'views/footer.php'); ?>
</html>