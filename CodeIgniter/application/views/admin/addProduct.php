<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= base_url("css/admin/addProduct.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/admin/productImage.css") ?> >
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
                        <input class="" type="number" min="0" max="9999.99" step="0.01" name="price" required>
                    </div>
                    
                    <div class="desc">
                        <label for="description" class="labelTypo" size="30" required>Description du Produit</label>
                        <textarea type="text" name="description" required></textarea>
                
                    </div>
        
                    <div class="available-container">
                        <label for="disponible">Disponibilité du produit</label>
                        <select name="disponible" id="disponible">
                            <option value="oui">Disponible</option>
                            <option value="non">Indisponible</option>
                        </select>
                        
                    </div>
                    
                    <label for="categories">Catégories</label>
                    <div id="categories"class="categories">
                        
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
                            <label for="image-upload"><img src="<?=base_url("assets/icon/icon-add-picture.svg")?>"> &nbsp; Ajouter des images</label>
                            <input id="image-upload" type="file" name="userfile[]" size="20" accept="image/png, image/jpeg" multiple required>
                        </div>
                        <div class="file-container">
                            <label for="model-upload"><img src="<?=base_url("assets/icon/icon-3d-model.svg")?>"> &nbsp; Choisir des modèles 3D</label>
                            <input id="model-upload" type="file" name="models[]" size="20" accept="model/obj, model/mtl, application/x-3ds, model/gltf+json, model/gltf-binary, model/stl, model/mesh" multiple required>
                            <p id="list-of-models"></p>
                        </div>
                    </div>
                    
                    
                    <button class="btn btn-black-200 btn-border-orange" id="submit-new-product-button" type="submit">Créer un nouveau produit</button>
                    <progress id='upload-progress' style='visibility: hidden' value="0" max="100"></progress>
                    <p id="traitement" style="visibility: hidden">Les fichiers ont été uploadés, ils sont maintenant en cours de traitement...</p>
                </div>    
            </form>

        </div>    

    </section>
    <script type="text/javascript" src=<?=base_url("js/productImage.js")?>></script>
</body>
<?php require_once(APPPATH.'views/footer.php'); ?>
</html>