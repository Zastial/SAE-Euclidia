<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de produit</title>
    <link rel="stylesheet" href=<?= base_url("css/modifProduct.css")?>>
</head>
<body>
    <?php require_once('error.php'); ?>
    <?php require_once('header.php'); ?>

    <section>
        <a class="link-nav" href=<?= site_url("Admin/index")?>> <img src="" alt=""> < Retour </a>
        
        
        <h1>Modification du produit </h1>

        <?php echo form_open("admin/modifProduct/".$produit->getId()) ?>
            <div>
                <label for="name">Nom du produit</label>
                <input type="text" name="name" id="name" value="<?php echo $produit->getTitre(); ?>">
            </div>
            <div>
                <label for="price">Prix du produit</label>
                <input type="number" step="0.1" name="price" id="price" value="<?php echo $produit->getPrix(); ?>">
            </div>
            <div>
                <label for="description">Description du produit</label>
                <input type="text" name="description" id="description" value="<?php echo $produit->getDescription(); ?>">
            </div>   
    

            <div class="categories-container">
                <label for="categorie">Catégorie du produit : </label>
                <div class="categorie-items">

                    <!--A REVOIR / SIMPLIIER --->




                    <?php foreach ($categories as $categorie) : ?>
                        <?php $val = false ?>
                        <?php foreach ($affectations as $affectation) : ?>
                            <?php if($produit->getID() == $affectation->getIdProduit() && $categorie->getID() == $affectation->getIdCategorie()) : ?>
                                <input type="checkbox" id="categories" name="categories[]" value="<?php echo $categorie->getId(); ?>" checked>
                                <label for="categorie"><?php echo $categorie->getLibelle(); ?></label>
                                <?php $val = true ?>
                            <?php endif ?>
                        <?php endforeach ?>
                        <?php if(!$val): ?>
                            <input type="checkbox" id="categories" name="categories[]" value="<?php echo $categorie->getId(); ?>">
                            <label for="categorie"><?php echo $categorie->getLibelle(); ?></label>
                        <?php endif ?>
                    <?php endforeach ?>



                    
                </div>
            </div>
    
            <div class="available-container">
                <label for="disponible">Disponibilité du produit : </label>
                <select name="disponible" id="disponible">
                    <option value="<?php echo ($produit->getDisponible()) ? "oui" : "non" ?>"><?php echo ($produit->getDisponible()) ? "oui" : "non" ?></option>
                    <option value="<?php echo ($produit->getDisponible()) ? "oui" : "non" ?>"><?php echo ($produit->getDisponible()) ? "non" : "oui" ?></option>
                </select>
            </div>
            
            <input class="btn btn-main btn-orange" type="submit" value="Modifier le produit">
    
        </form>
    
    </section>
    
    <?php require_once('footer.php'); ?>
</body>
</html>