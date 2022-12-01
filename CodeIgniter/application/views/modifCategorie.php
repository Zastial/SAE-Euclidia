<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifCategorie</title>
</head>
<body>
    <?php require_once('error.php'); ?>
    <?php require_once('header.php'); ?>

    <?php echo form_open("admin/modifCategorie/".$produit->getId()) ?>


    <div class="return">
            <a class="link-nav" href=<?= site_url("Admin/index")?>> <img src="" alt=""> < Retour </a>
    </div>


        <label for="name">Nom du produit</label>
        <input type="text" name="name" id="name" value="<?php echo $produit->getTitre(); ?>">

        <label for="price">Prix du produit</label>
        <input type="number" step="0.1" name="price" id="price" value="<?php echo $produit->getPrix(); ?>">

        <label for="description">Description du produit</label>
        <input type="text" name="description" id="description" value="<?php echo $produit->getDescription(); ?>">

        <label for="categorie">Catégorie du produit</label>
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
        <?php endforeach ?><br>

        <label for="disponible">Disponibilité du produit</label>
        <select name="disponible" id="disponible">
            <option value="<?php echo ($produit->getDisponible()) ? "oui" : "non" ?>"><?php echo ($produit->getDisponible()) ? "oui" : "non" ?></option>
            <option value="<?php echo ($produit->getDisponible()) ? "oui" : "non" ?>"><?php echo ($produit->getDisponible()) ? "non" : "oui" ?></option>
        </select><br>
        
        <input class="btn btn-main btn-orange" type="submit" value="Modifier le produit">

    </form>

    <?php require_once('footer.php'); ?>
    
</body>
</html>